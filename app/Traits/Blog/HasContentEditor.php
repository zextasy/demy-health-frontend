<?php

namespace App\Traits\Blog;

trait HasContentEditor
{
    public static function getContentEditor(string $field)
    {
        $defaultEditor = config('blog.editor');

        return $defaultEditor::make($field)
            ->label(__('blog.content'))
            ->required()
            ->toolbarButtons(config('blog.toolbar_buttons'))
            ->columnSpan([
                'sm' => 2,
            ]);
    }
}
