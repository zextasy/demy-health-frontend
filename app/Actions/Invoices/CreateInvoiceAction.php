<?php

namespace App\Actions\Invoices;


use App\Models\Finance\Invoice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Events\InvoiceCreatedEvent;
use App\Contracts\InvoiceableContract;
use App\Contracts\InvoiceableCustomerContract;
use App\Actions\InvoiceItems\CreateInvoiceItemAction;

class CreateInvoiceAction
{
    private Invoice $invoice;

    private ?InvoiceableCustomerContract $invoiceableCustomer;

    private ?InvoiceableContract $invoiceable;

    public function run(Collection $invoiceItems, string $customerEmail): Invoice
    {
        $this->invoice = new Invoice;
        $this->invoice->customer_email = $customerEmail;
        $this->invoice->invoiceable_id = $this->invoiceable?->getLaravelMorphModelId();
        $this->invoice->invoiceable_type = $this->invoiceable?->getLaravelMorphModelType();
        $this->invoice->customer_id = $this->invoiceableCustomer?->getLaravelMorphModelId();
        $this->invoice->customer_type = $this->invoiceableCustomer?->getLaravelMorphModelType();
        DB::transaction(function () use ($invoiceItems) {
            $this->invoice->save();
            foreach ($invoiceItems as $invoiceItem) {
                (new CreateInvoiceItemAction)
                    ->run(
                        $this->invoice,
                        $invoiceItem->get('model'),
                        $invoiceItem->get('quantity'),
                        $invoiceItem->get('name'),
                        floatval($invoiceItem->get('price'))
                    );
            }
        });

        $this->raiseEvents();

        return $this->invoice;
    }

    public function forInvoiceableCustomer(null|InvoiceableCustomerContract $invoiceableCustomer): self
    {
        $this->invoiceableCustomer = $invoiceableCustomer;

        return $this;
    }

    public function forInvoiceable(null|InvoiceableContract $invoiceable): self
    {
        $this->invoiceable = $invoiceable;

        return $this;
    }

    private function raiseEvents()
    {
        InvoiceCreatedEvent::dispatch($this->invoice);
    }
}
