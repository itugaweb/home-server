<!DOCTYPE html>
<html lang="{{c.l.c1}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{c.l.title}}</title>
    <link rel="icon" href="/{{c.dirs.template}}favicon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/{{c.dirs.composer}}twbs/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="/{{c.dirs.template}}css/main.css"/>
</head>
<body>
<div class="container my-3 rounded">
    <div class="header clearfix">
        <ul class="lang float-right list-inline">
            <li class="list-inline-item"><a href="?l=en-US"><img src="/{{c.dirs.images}}flags/en-US.png" alt="en-US.png"
                                                                 title="{{c.l.enUS}}"
                                                                 width="16"/></a></li>
            <li class="list-inline-item"><a href="?l=pt-PT"><img src="/{{c.dirs.images}}flags/pt-PT.png" alt="pt-PT.png"
                                                                 title="{{c.l.ptPT}}"
                                                                 width="16"/></a></li>
        </ul>
        <a href="/" class="float-left"><img src="/{{c.dirs.template}}images/logo.png" alt="logo.png"/></a>
    </div>
    <hr>
    <div class="content row justify-content-around">
        <div class="col-6 col-md-3">
            <div class="main-card card">
                <h5 class="card-title"><i class="fas fa-wrench"></i> {{c.l.tools}} {{c.tools.collapse|raw}}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/?phpinfo=1" target="_blank"><i class="fas fa-wrench"></i> PHP
                            Info</a></li>
                    <li class="list-group-item"><a href="/phpmyadmin/" target="_blank"><i class="fas fa-wrench"></i>
                            PHPMyAdmin</a></li>
                    {{c.tools.content|raw}}
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="main-card card">
                <h5 class="card-title"><i class="fas fa-star"></i> {{c.l.projects}} {{c.projects.collapse|raw}}</h5>
                <ul class="list-group list-group-flush">
                    {% if c.projects.content is empty %}
                    {{c.l.noProjects|raw}}
                    {% else %}
                    {{c.projects.content|raw}}
                    {% endif %}
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="main-card card">
                <h5 class="card-title"><i
                            class="fas fa-exclamation-triangle"></i> {{c.l.tests}} {{c.tests.collapse|raw}}</h5>
                <ul class="list-group list-group-flush">
                    {% if c.tests.content is empty %}
                    {{c.l.noTests|raw}}
                    {% else %}
                    {{c.tests.content|raw}}
                    {% endif %}
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="main-card card">
                <h5 class="card-title"><i class="fas fa-link"></i> {{c.l.links}} {{c.links.collapse|raw}}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{c.companyLink}}" target="_blank"><i
                                    class="fas fa-link"></i> {{c.company}}</a></li>
                    {{c.links.content|raw}}
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="footer clearfix">
        <ul class="links float-right list-inline">
            <li class="list-inline-item"><a href="{{c.companyLink}}" target="_blank">{{c.company}}</a></li>
        </ul>
        <div class="float-left">&copy; {{c.company}} {{c.year}}</div>
    </div>
</div>
<!-- jQuery  -->
<script src="/{{c.dirs.composer}}components/jquery/jquery.min.js"></script>
<!-- Bootstrap  -->
<script src="/{{c.dirs.composer}}twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>