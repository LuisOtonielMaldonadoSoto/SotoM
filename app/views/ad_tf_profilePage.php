<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link href="public/css/ad_tf_style.css" rel="stylesheet"> <!-- Archivo CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> <!-- Font Awesome -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="d-flex flex-column min-vh-100">
<header class="bg-primary text-white px-4 py-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
      <div class="rounded-circle overflow-hidden header-avatar">
        <img class="img-fluid" alt="@shadcn" src="/placeholder-user.jpg">
      </div>
      <div class="ml-3">
        <div class="h5 mb-0">Jared Palmer</div>
        <div class="small text-light">Software Engineer</div>
      </div>
    </div>
    <div class="d-flex align-items-center">
      <a href="#" class="btn btn-light mr-2">Editar Perfil</a>
      <button class="btn btn-outline-light" aria-label="Configuraciones">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
          <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
          <circle cx="12" cy="12" r="3"></circle>
        </svg>
      </button>
    </div>
  </header>

  <main class="flex-fill bg-light">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-4">
          <div class="mb-4">
            <div class="h6 text-muted">Sobre mí</div>
            <p>Soy un ingeniero de software con una pasión por construir aplicaciones web hermosas y funcionales. Tengo experiencia trabajando con una variedad de tecnologías, incluyendo React, Node.js y MongoDB.</p>
          </div>
          <div class="mb-4">
            <div class="h6 text-muted">Ubicación</div>
            <div>San Francisco, CA</div>
          </div>
          <div class="mb-4">
            <div class="h6 text-muted">Ingresó</div>
            <div>Junio 2021</div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="mb-4">
            <div class="h6 text-muted">Proyectos</div>
            <div class="row">
              <div class="col-sm-6 mb-3">
                <div class="card h-100">
                  <div class="card-body">
                    <h5 class="card-title">Acme Inc</h5>
                    <p class="card-text">Una aplicación web para gestionar proyectos y tareas.</p>
                  </div>
                  <div class="card-footer">
                    <a href="#" class="text-muted">Ver en GitHub</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 mb-3">
                <div class="card h-100">
                  <div class="card-body">
                    <h5 class="card-title">Widgets</h5>
                    <p class="card-text">Una colección de componentes de interfaz de usuario reutilizables.</p>
                  </div>
                  <div class="card-footer">
                    <a href="#" class="text-muted">Ver en GitHub</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="h6 text-muted">Experiencia</div>
            <div class="mb-3">
              <h5 class="mb-1">Ingeniero de Software</h5>
              <div class="text-muted">Acme Inc, 2021 - Presente</div>
              <p>Desarrollé y mantuve aplicaciones web utilizando React, Node.js y MongoDB.</p>
            </div>
            <div class="mb-3">
              <h5 class="mb-1">Pasante</h5>
              <div class="text-muted">Widgets Inc, 2020 - 2021</div>
              <p>Contribuí al desarrollo de una biblioteca de componentes de interfaz de usuario utilizando React y Storybook.</p>
            </div>
          </div>

          <div class="mb-4">
            <div class="h6 text-muted">Habilidades</div>
            <div class="d-flex flex-wrap">
              <span class="badge badge-primary mr-2 mb-2">React</span>
              <span class="badge badge-primary mr-2 mb-2">Node.js</span>
              <span class="badge badge-primary mr-2 mb-2">MongoDB</span>
              <span class="badge badge-primary mr-2 mb-2">JavaScript</span>
              <span class="badge badge-primary mr-2 mb-2">CSS</span>
              <span class="badge badge-primary mr-2 mb-2">Git</span>
            </div>
          </div>

          <div class="mb-4">
            <div class="h6 text-muted">Logros</div>
            <div class="mb-3">
              <h5 class="mb-1">Ganador de Hackathon</h5>
              <div class="text-muted">Acme Hackathon, 2022</div>
              <p>Gané el Acme Hackathon con un equipo por construir una aplicación web innovadora.</p>
            </div>
            <div class="mb-3">
              <h5 class="mb-1">Colaborador de Código Abierto</h5>
              <div class="text-muted">Widgets Library, 2021</div>
              <p>Contribuí al proyecto de código abierto Widgets Library, corrigiendo errores y agregando nuevas funciones.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-secondary text-white px-4 py-4 d-flex justify-content-between">
    <p class="mb-0">© 2024 Acme Inc. Todos los derechos reservados.</p>
    <div>
      <a class="text-white mr-2" href="#">Privacidad</a>
      <a class="text-white" href="#">Términos</a>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>