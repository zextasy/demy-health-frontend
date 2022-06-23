
<x-email-layout>
    <x-email.h1>Hello!</x-email.h1>
    <x-email.p>Your test results for booking ref: {{$result->testBooking->reference}} has been generated  on {{$result->created_at->toDayDateTimeString()}}.</x-email.p>
    <x-email.p>Please see the attached file for more details</x-email.p>
    <x-email.p>Your result reference is {{$result->reference}}. Please keep this number safe. It will be used to retrieve your result information</x-email.p>
{{--    <x-email.p>Your summary is below</x-email.p>--}}
{{--    <br>--}}
{{--    <hr>--}}
{{--    <table >--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Item</th>--}}
{{--            <th>Price</th>--}}
{{--            <th>Quantity</th>--}}
{{--            <th>Subtotal</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($result->items as $resultItem)--}}
{{--            <tr>--}}
{{--                <td>{{$resultItem->name}}</td>--}}
{{--                <td>{{number_format($resultItem->price)}}</td>--}}
{{--                <td>{{$resultItem->quantity}}</td>--}}
{{--                <td>{{number_format($resultItem->total_amount)}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <td colspan="4" >--}}
{{--                <strong><span class="text-left">Total</span>&nbsp;<span class="text-right">{{number_format($result->total_amount)}}</span></strong>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
{{--    </table>--}}
{{--    <hr>--}}
{{--    <br>--}}
    <x-email.p>If you have registered on our site with this email, you can log in and view the details</x-email.p>
    <x-email.p>Regards,<br>DemyHealth</x-email.p>
    <x-email.p>Thank you for Choosing DemyHealth!</x-email.p>
</x-email-layout>
