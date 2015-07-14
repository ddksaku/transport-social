<!DOCTYPE html>
<html lang=”en”>
  <head>
    {{ HTML::style("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css") }}
    {{ HTML::style("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css") }}
    {{ HTML::style("css/style.css") }}
    {{ HTML::style('css/jquery-ui.css') }}
    {{ Asset::container('assets')->styles() }}
    @yield('stylesheets')
    <meta charset="UTF-8" />
    <title>Transport Social</title>
  </head>
  <body>
    <div class="container">
      @include("_partials.header")
      <div class="main">
        <div class="panel panel-default">
          <div class="content panel-body">
            @yield("content")
          </div>
        </div>
      </div>
      @include("_partials.footer")
    </div>
    {{ HTML::script("http://code.jquery.com/jquery-latest.min.js") }}
    {{ Html::script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js") }}
    {{ HTML::script("//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js") }}
    {{ Asset::container('assets')->scripts() }}
    @yield('scripts')
  </body>
</html>