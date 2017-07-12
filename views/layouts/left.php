<aside class="main-sidebar" style="background: #363636;">

    <section class="sidebar">
        <!-- Itens do menu -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Meu menu', 'options' => ['class' => 'header','style' => 'background:#ccc;color:#000;font-weight: bold;']],
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['/site/'],],
                    ['label' => 'Protocolos', 'icon' => 'list', 'url' => ['/meus-protocolos'],],
                    ['label' => 'Departamentos', 'icon' => 'tags', 'url' => ['/departamento'],],
                    ['label' => 'Funcionários', 'icon' => 'users', 'url' => ['/funcionario'],],
                    ['label' => 'Follow-Ups', 'icon' => 'commenting', 'url' => ['/follow-up'],]

                ]

            ]
        ) ?>

    </section>

</aside>


