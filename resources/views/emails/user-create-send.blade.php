<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <title>Movie Plus - Nuevo usuario</title>
    </head>

    <body>
        <h1><i class="mr-2 fa-solid fa-film"></i> Movie Plus</h1>
        <p><strong>{{ Str::title($name) }}</strong> te damos la bienvenida a Movie Plus. En el sitio podrás encontrar
            información sobre películas del momento, como país de orígen, duración, género, actores, directores, etc.
        </p>
        <p>También podrás votar cada película que sea de tu agrado. Agradecemos que seas parte de <strong>Movie
                Pus</strong> y esperamos que disfrutes de todo el contenido disponible en el sitio.</p>
        <p class="fs-6 text-secondary">Equipo de <i class="mr-2 fa-solid fa-film"></i> Movie Plus</p>
    </body>

</html>
