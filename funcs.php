<?php
function printFooterScripts() {
    echo "<script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\"></script>";
    echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js\"></script>";
    echo "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js\"></script>";
}

function printNavBar() {
    echo "<h3 class=\"text-muted\">Панель управления</h3>
        <nav class=\"navbar navbar-expand-md navbar-light bg-light rounded mb-3\">
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarCollapse\" aria-controls=\"navbarCollapse\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarCollapse\">
                <ul class=\"navbar-nav text-md-center nav-justified w-100\">
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Товары</a>
                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdown01\">
                            <a href=\"listgoods.php\" class=\"dropdown-item\">Справочник товаров</a>
                            <a href=\"addgood.php\" class=\"dropdown-item\">Добавить товар</a>
                        </div>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown02\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Ссылки</a>
                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdown02\">
                            <a href=\"listlinks.php\" class=\"dropdown-item\">Список ссылок</a>
                            <a href=\"addlink.php\" class=\"dropdown-item\">Добавить ссылку</a>
                        </div>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown03\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Магазины</a>
                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdown03\">
                            <a href=\"listlinks.php\" class=\"dropdown-item\">Список магазинов</a>
                            <a href=\"addshop.php\" class=\"dropdown-item\">Добавить магазин</a>
                        </div>
                    </li>
                    <li class=\"nav-item\"><a href=\"index.php\" class=\"nav-link\">Главная</a></li>
                </ul>
            </div>
        </nav>";
}