
@php
    $inputId = random_str(5) ?? $name.'-ckeditor_id';
    if (!empty($id) && isset($id)) {
        $inputId = $id;
    }
    $error = $errors->has($name) ? 'is-invalid' : '';

@endphp
<textarea id="{{ $inputId }}" {!! $attributes->merge(['class' => 'form-control ' . $error]) !!}>{{ $slot }}</textarea>
    
<script type="module" defer>
    ClassicEditor
        .create( document.querySelector( '#{{ $inputId }}' ), {
            plugins: [ 
                Autoformat,
                BlockQuote,
                Bold,
                CloudServices,
                Essentials,
                FindAndReplace,
                Font,
                Heading,
                Image,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                ImageUpload,
                Base64UploadAdapter,
                Indent,
                IndentBlock,
                Italic,
                Link,
                List,
                MediaEmbed,
                Mention,
                Paragraph,
                PasteFromOffice,
                PictureEditing,
                SourceEditing,
                Table,
                TableColumnResize,
                TableToolbar,
                TextTransformation,
                Underline,
                HtmlEmbed,
                CodeBlock,
                RemoveFormat,
                Code,
                SpecialCharacters,
                HorizontalLine,
                PageBreak,
                TodoList,
                Strikethrough,
                Subscript,
                Superscript,
                Highlight,
                Alignment,
            ],
            toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'sourceEditing',
                        '|',
                        '|',
                        'findAndReplace', 'selectAll',
                        '|',
                        'heading',
                        '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                        '-',
                        'bold', 'italic', 'underline',
                        {
                            label: 'Formatting',
                            icon: 'text',
                            items: [ 'strikethrough', 'subscript', 'superscript', 'code', '|', 'removeFormat' ]
                        },
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak',
                        '|',
                        'link', 'insertImage', 'insertTable',
                        {
                            label: 'Insert',
                            icon: 'plus',
                            items: [ 'highlight', 'blockQuote', 'mediaEmbed', 'codeBlock', 'htmlEmbed' ]
                        },
                        'alignment',
                        '|',
                        'bulletedList', 'numberedList', 'todoList',
                        {
                            label: 'Indents',
                            icon: 'plus',
                            items: [ 'outdent', 'indent' ]
                        }
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Enter the full description of the project',
                image: {
                    resizeOptions: [
                        {
                            name: 'resizeImage:original',
                            label: 'Default image width',
                            value: null
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50% page width',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75% page width',
                            value: '75'
                        }
                    ],
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        '|',
                        'resizeImage'
                    ],
                },
                link: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://'
                },
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ],
                },
        } ).catch( err => {
			console.error( err.stack );
		} );
</script> 
