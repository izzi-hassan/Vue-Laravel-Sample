<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    private function page()
    {
        // Content
        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Content</h2><hr>',
                    ]);


        $this->crud->addField([  // Select2
            'label' => "Parent",
            'type' => 'select2',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\\Models\\Page",
            'allows_null' => false
        ]);

        $this->crud->addField([ // Text
            'name' => 'heading',
            'label' => "Heading",
            'type' => 'text',
            'allows_null' => false
        ]);

        $this->crud->addField([ // Text
            'name' => 'subheading',
            'label' => "Sub-Heading",
            'type' => 'text'
        ]);

        $this->crud->addField([ // image
            'label' => "Cover Image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'prefix' => 'uploads/images/pages/cover-images/' // in case you only store the filename in the database, this text will be prepended to the database value
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg',
            'placeholder' => '',
        ]);

        // META & Notes
        $this->crud->addField([
            'name' => 'metas_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>Meta and Notes</h2><hr>',
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => 'Meta Title',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => 'Meta Description',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_keywords',
            'type' => 'textarea',
            'label' => 'Meta Keywords',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);
    }

    private function microsite()
    {
        // Content
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>Content</h2><hr>',
        ]);


        $this->crud->addField([  // Select2
            'label' => "Parent",
            'type' => 'select2',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\\Models\\Page",
            'allows_null' => false
        ]);

        $this->crud->addField([ // Text
            'name' => 'heading',
            'label' => "Heading",
            'type' => 'text',
            'allows_null' => false
        ]);

        $this->crud->addField([ // image
            'label' => "Cover Image",
            'name' => "cover_image",
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg',
            'placeholder' => '',
        ]);

        // META & Notes
        $this->crud->addField([
            'name' => 'metas_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>Meta and Notes</h2><hr>',
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => 'Meta Title',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => 'Meta Description',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_keywords',
            'type' => 'textarea',
            'label' => 'Meta Keywords',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);
    }

    private function homepage()
    {
        // Content
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>Content</h2><hr>',
        ]);

        $this->crud->addField([ // Text
            'name' => 'heading',
            'label' => "Heading",
            'type' => 'text',
            'allows_null' => false
        ]);

        $this->crud->addField([ // Text
            'name' => 'subheading',
            'label' => "Sub-Heading",
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg',
            'placeholder' => '',
        ]);

        // META & Notes
        $this->crud->addField([
            'name' => 'metas_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>Meta and Notes</h2><hr>',
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => 'Meta Title',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => 'Meta Description',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'meta_keywords',
            'type' => 'textarea',
            'label' => 'Meta Keywords',
            'fake' => true,
            'store_in' => 'meta',
        ]);

        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);
    }
}
