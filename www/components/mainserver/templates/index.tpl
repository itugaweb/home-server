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