<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand(config('app.name'), url('/'));
    if(Auth::check()){
        $arrayLinks =
        [
                [
                        'link' => route('categories.index'),
                        'title' => 'Categories',
                        'permission' => 'category-admin/list'

                ],
                [
                        'Books',
                        [
                                [
                                        'link' => route('books.index'),
                                        'title' => 'List',
                                        'permission' => 'book-admin/list'


                                ],
                                [
                                        'link' => route('trashed.books.index'),
                                        'title' => 'Trash',
                                        'permission' => 'book-trashed-admin/list'
                                ]
                        ]
                ],

                [
                        'Users',
                        [
                                [
                                        'link' => route('codeeduuser.users.index'),
                                        'title' => 'Users',
                                        'permission' => 'user-admin/list'
                                ],
                                [
                                        'link' => route('codeeduuser.roles.index'),
                                        'title' => 'Roles',
                                        'permission' => 'role-admin/list'
                                ],
                        ]
                ]
        ];
    $links = Navigation::links(\NavbarAuthorization::getLinksAuthorized($arrayLinks));
    $logout = Navigation::links([
            [
                    Auth::user()->name,
                    [
                            [
                                    'link' => url('/logout'),
                                    'title' => 'Logout',
                                    'linkAttributes' => [
                                            'onlclick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                                    ]

                            ]
                    ]
            ]
    ])->right();
    $navbar->withContent($links)->withContent($logout);

    }

    ?>
    {!! $navbar !!}
    {!! Form::open(['url' => url('/logout'), 'method'=> 'POST', 'id' => 'logout-form', 'style' => 'display:none']) !!}
    {!! Form::close() !!}

    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="container">
            {!! Alert::danger(Session::get('error'))->close() !!}
        </div>
    @endif



    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
@stack('scripts');
</body>
</html>
