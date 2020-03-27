<!DOCTYPE html>
<html lang="{{c.l.c1}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{c.l.title}}</title>
    <link rel="icon" href="{{c.url.template}}favicon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{c.url.composer}}twbs/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{c.url.template}}css/main.css"/>
</head>
<body>
<div class="container my-3 rounded">
    <div class="header clearfix">
        <ul class="lang float-right list-inline">
            <li class="list-inline-item"><a href="?l=en-US"><img src="{{c.url.images}}flags/en-US.png" alt="en-US.png"
                                                                 title="{{c.l.enUS}}"
                                                                 width="16"/></a></li>
            <li class="list-inline-item"><a href="?l=pt-PT"><img src="{{c.url.images}}flags/pt-PT.png" alt="pt-PT.png"
                                                                 title="{{c.l.ptPT}}"
                                                                 width="16"/></a></li>
        </ul>
        <a href="/" class="float-left"><img src="{{c.url.template}}images/logo.png" alt="logo.png"/></a>
    </div>
    <hr>
    {{ c.component | raw }}
    <hr>
    <div class="footer clearfix">
        <ul class="links float-right list-inline">
            <li class="list-inline-item"><a href="{{c.companyLink}}" target="_blank">{{c.company}}</a></li>
        </ul>
        <div class="float-left">&copy; {{c.company}} {{c.year}}</div>
    </div>
</div>
<!-- jQuery  -->
<script src="{{c.url.composer}}components/jquery/jquery.min.js"></script>
<!-- Bootstrap  -->
<script src="{{c.url.composer}}twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>