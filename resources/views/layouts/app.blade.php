<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-dark fixed-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="">Gerenciador de Vendas</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Buscar venda por cliente" aria-label="Search">

      </nav>

      <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="{{ route('dashboard.index') }}">
                    <span data-feather="home"></span>
                    Painel de Controle <span class="sr-only"></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('sale.index') }}">
                    <span data-feather="file"></span>
                   Lista Vendas
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('client.index') }}">
                    <span data-feather="users"></span>
                   Lista Clientes
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('product.index') }}">
                    <span data-feather="plus-circle"></span>
                   Lista Produtos
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h4>Painel de Controle</h4>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                  <a href="{{ route('client.create') }}" class="btn btn-sm btn-outline-secondary">Criar Cliente</a>
                  <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-secondary">Criar Produto</a>
                  <a href="{{ route('sale.create') }}" class="btn btn-sm btn-outline-secondary">Criar uma Venda</a>
                  <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-outline-secondary">Home</a>

                </div>

              </div>
            </div>

           @yield('content')


          </main>
        </div>
      </div>

<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('site/bootstrap.js') }}"></script>
<script src="{{ asset('site/feather.min.js') }}"></script>
<script src="{{ asset('site/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}

</body>
</html>
