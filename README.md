# Blade Renderer

`Blade Renderer` is a simple wrapper around [`illuminate/view`](https://github.com/illuminate/view), the package that powers the [`Blade`](https://laravel.com/docs/master/blade) templating engine used with [`Laravel`](https://laravel.com/docs/master).

This package allows Blade's powerful and expressive syntax to be uesd in any PHP project without needing to install the full Laravel framework. It abstracts the setup and configuration needed to render blade templates, making it more accessible and straightforward for use in non-Laravel projects.

It uses a similar directory structure as Laravel for organizing `views` and `caches`.  
The views are stored at the `resources/views` directory and the view caches at `storage/framework/views`.

# Usage

`Blade Renderer` can be used in either of the following two ways.

## As a Standalone Project

You can use Blade Renderer to quickly start a new standalone project. To do this, follow these steps:

1.  Create a New Project

    Run the following command in your terminal to create a new project.

    ```sh
    composer create-project abitofmaya/blade-renderer <project-name>
    ```

2.  Run the Development Server

    Navigate into the project directory and start a PHP development server by running:

    ```sh
    php -S localhost:8000 -t public
    ```

### Example

-   Edit `src/app.php` with the following contents:

    ```php
    <?php

    use abitofmaya\BladeRenderer\BladeRenderer;

    $renderer = new BladeRenderer();

    $posts = [
        [
            'title' => 'The Art of Minimalism: Living with Less',
            'description' => 'Learn how to declutter your life and find happiness in simplicity.'
        ],
        [
            'title' => 'The Future of Technology',
            'description' => 'Dive into the technological advancements shaping the future.'
        ]
    ];

    echo $renderer->view(view: 'bladeRenderer', data: ['posts' => $posts]);
    ```

-   Create `bladeRenderer.blade.php` in `resources/views` directory with the following contents.

    ```html
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1.0"
            />
            <title>Blade Renderer</title>
        </head>

        <body>
            @foreach($posts as $post)
            <div>
                <p><strong>Title</strong>: {{ $post['title'] }}</p>
                <p><strong>Description</strong>: {{ $post['description'] }}</p>
            </div>
            @endforeach
        </body>
    </html>
    ```

## As a Dependency in an Existing Project

If you have an existing PHP project and want to add Blade templating capabilities, you can include Blade Renderer as a project dependency. Here's how:

1. Install the Package

    Run the following command in your terminal to install Blade Renderer.

    ```sh
    composer require abitofmaya/blade-renderer
    ```

2. Setup Directory Structure

    After installation, you will need to manually set up the directory structure for the views and caches. Create the following directories:

    - `resources/views` for storing your Blade templates.
    - `storage/framework/views` for storing view caches.
