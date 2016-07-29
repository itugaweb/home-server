<!DOCTYPE html>
<html lang="{{c.l.c1}}">
<head>
    <meta charset="utf-8">

    <title>{{c.l.title}}</title>
    <link rel="icon" href="/{{c.dirs.template}}favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.4/css/uikit.min.css"/>
    <link rel="stylesheet" href="/{{c.dirs.template}}css/main.css"/>
</head>
<body>
<div class="uk-container uk-container-center uk-margin-top uk-margin-bottom uk-border-rounded">
    <div class="header uk-clearfix">
        <ul class="uk-float-right uk-list lang">
            <li><a href="?l=en-US"><img src="/{{c.dirs.images}}flags/en-US.png" alt="en-US.png" title="{{c.l.enUS}}"
                                        width="16"/></a></li>
            <li><a href="?l=pt-PT"><img src="/{{c.dirs.images}}flags/pt-PT.png" alt="pt-PT.png" title="{{c.l.ptPT}}"
                                        width="16"/></a></li>
        </ul>
        <a href="/" class="uk-float-left"><img src="/{{c.dirs.template}}images/logo.png" alt="logo.png"/></a>
    </div>
    <hr>
    <div class="uk-grid " data-uk-grid-margin="">
        <div class="uk-width-small-1-2 uk-width-medium-1-4">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">
                    <i class="uk-icon-wrench uk-icon-small"></i> {{c.l.tools}} {{c.tools.collapse|raw}}
                </h3>
                <ul class="uk-list">
                    <li><a href="/?phpinfo=1" target="_blank"> <i class="uk-icon-wrench"></i> PHP Info</a></li>
                    <li><a href="/phpmyadmin/" target="_blank"> <i class="uk-icon-wrench"></i> PHPMyAdmin</a></li>
                    {{c.tools.content|raw}}
                </ul>
            </div>
        </div>
        <div class="uk-width-small-1-2 uk-width-medium-1-4">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">
                    <i class="uk-icon-star uk-icon-small"></i> {{c.l.projects}} {{c.projects.collapse|raw}}
                </h3>
                <ul class="uk-list">
                    {% if c.projects.content is empty %}
                    {{c.l.noProjects|raw}}
                    {% else %}
                    {{c.projects.content|raw}}
                    {% endif %}
                </ul>
            </div>
        </div>
        <div class="uk-width-small-1-2 uk-width-medium-1-4">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">
                    <i class="uk-icon-warning uk-icon-small"></i> {{c.l.tests}} {{c.tests.collapse|raw}}
                </h3>
                <ul class="uk-list">
                    {% if c.tests.content is empty %}
                    {{c.l.noTests|raw}}
                    {% else %}
                    {{c.tests.content|raw}}
                    {% endif %}
                </ul>
            </div>
        </div>
        <div class="uk-width-small-1-2 uk-width-medium-1-4">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">
                    <i class="uk-icon-link uk-icon-small"></i> {{c.l.links}} {{c.links.collapse|raw}}
                </h3>
                <ul class="uk-list">
                    <li><a href="{{c.companyLink}}" target="_blank"> <i class="uk-icon-link"></i> {{c.company}}</a></li>
                    {{c.links.content|raw}}
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="footer uk-clearfix">
        <ul class="uk-float-right uk-list links">
            <li><a href="{{c.companyLink}}" target="_blank">{{c.company}}</a></li>
        </ul>
        <div class="uk-float-left">&copy; {{c.company}} {{c.year}}</div>
    </div>
</div>
<!-- jQuery  -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js"
        integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!-- Bootstrap's core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.4/js/uikit.min.js"></script>
</body>
</html>
