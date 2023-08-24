<?php

namespace App\Services;

use App\Enums\FieldTypeEnum;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use App\Contracts\VirtualFieldableContract;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use App\Exceptions\UnexpectedMatchValueException;

class VirtualFieldService
{

    /**
     * @throws UnexpectedMatchValueException
     */
    public function getFilamentFormFields(?VirtualFieldableContract $virtualFieldsContract):array
    {
        $filamentFields = [];
        if (empty($virtualFieldsContract)) {
            return $filamentFields;
        }
        $fields = $virtualFieldsContract->virtualFields()->get();
        foreach ($fields as $field) {
            $value = $field->field_type instanceof FieldTypeEnum ? $field->field_type->value : $field->field_type;
            $filamentFields[] = match ($value) {
                FieldTypeEnum::BOOLEAN_RADIO->value => Radio::make($field->name)->label($field->label)
                    ->boolean(),
                FieldTypeEnum::CHECK_BOX_LIST->value => CheckboxList::make($field->name)->label($field->label),
                FieldTypeEnum::CHECKBOX->value => Checkbox::make($field->name)->label($field->label),
                FieldTypeEnum::COLOR->value => ColorPicker::make($field->name)->label($field->label),
                FieldTypeEnum::DATE->value => DatePicker::make($field->name)->label($field->label),
                FieldTypeEnum::DATETIME->value => DateTimePicker::make($field->name)->label($field->label),
                FieldTypeEnum::DECIMAL->value => TextInput::make($field->name)->label($field->label)
                    ->numeric()->mask(fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)),
                FieldTypeEnum::FILE->value => FileUpload::make($field->name)->label($field->label),
                FieldTypeEnum::INTEGER->value => TextInput::make($field->name)->label($field->label)
                    ->numeric(),
                FieldTypeEnum::KEY_VALUE->value => KeyValue::make($field->name)->label($field->label),
                FieldTypeEnum::MULTISELECT->value => Select::make($field->name)->label($field->label)
                    ->options($field->options)->multiple(),
                FieldTypeEnum::RADIO->value => Radio::make($field->name)->label($field->label),
                FieldTypeEnum::SELECT->value => Select::make($field->name)->label($field->label)
                    ->options($field->options),
                FieldTypeEnum::TAG->value => TagsInput::make($field->name)->label($field->label)
                    ->suggestions($field->options),
                FieldTypeEnum::TOGGLE->value => Toggle::make($field->name)->label($field->label),
                FieldTypeEnum::TEXT->value => TextInput::make($field->name)->label($field->label),
                FieldTypeEnum::TEXTAREA->value => Textarea::make($field->name)->label($field->label),
                default => throw new UnexpectedMatchValueException(),
            };
        }
        return $filamentFields;
    }
	//FIXME issue with multiselect, selcet? and tags input. investigate
}
