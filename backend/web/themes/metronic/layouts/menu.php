<div class="page-sidebar navbar-collapse collapse">

    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->


    <ul class="<?= $this->params['sidebarMenuClass'] ?>" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler">
                <span></span>
            </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
            <form class="sidebar-search  " action="#" method="POST">
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <?php
        foreach ($this->params['mainMenu'] as $item) { //Cap 1
            if ($item) {
                $active = false;
                $classes = ["nav-item"];
                if(isset($item['active']) AND $item['active']) {
                    $classes[] = 'active';
                    $active = true;
                }
                if(isset($item['display']) AND !$item['display']) {
                    $classes[] = 'hide';
                }

                $icon = empty($item['icon']) ? 'fa fa-list' : $item['icon'];
                $url = empty($item['url']) ? 'javascript:;' : $item['url'];
                $name = empty($item['name']) ? 'Menu' : $item['name'];

                if (isset ($item['children']) AND is_array($item['children'])) {
                    $countChildren = 0;

                    foreach ($item['children'] as $child) {
                        if ($child) $countChildren++;
                    }

                    if ($countChildren == 0) continue;

                    if($active) {
                        $classes[] = "open";
                    }

                    $class = implode(' ', $classes);
                    ?>
                    <li class="<?= $class ?>">
                        <a class="active nav-link nav-toggle" href="<?= $url ?>">
                            <i class="<?= $icon ?>"></i>
                            <span class="title"><?= \yii\helpers\Html::decode($name) ?></span>
                            <?php if ($countChildren != 0) { ?>
                                <?php if($active) { ?>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                <?php } else { ?>
                                    <span class="arrow"></span>
                                <?php } ?>
                            <?php } ?>
                        </a>

                        <ul class="sub-menu">
                            <?php foreach ($item['children'] as $children) { // Cap 2

                                $children_active = false;
                                $children_classes = ["nav-item"];
                                if(isset($children['active']) AND $children['active']) {
                                    $children_classes[] = 'active open';
                                    $children_active = true;
                                }

                                if(isset($children['display']) AND !$children['display']) {
                                    $children_classes[] = 'hide';
                                }


                                $children_icon = empty($children['icon']) ? 'fa fa-list' : $children['icon'];
                                $children_url = empty($children['url']) ? 'javascript:;' : $children['url'];
                                $children_name = empty($children['name']) ? 'Menu' : $children['name'];
                                $children_class = implode(' ', $children_classes);

                                ?>
                                <li class="<?= $children_class ?>">
                                    <a href="<?= $children_url ?>"
                                       class="nav-link nav-toggle">
                                        <i class="<?= $children_icon ?>"></i>
                                        <span class="title"><?= \yii\helpers\Html::decode($children_name) ?></span>
                                            <?php if($children_active) { ?>
                                                <span class="selected"></span>
                                            <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                } else {
                    if (isset($item['url'])) {
                        if($item['icon'] == 'glyphicon glyphicon-home') {
                            $classes[] = 'start';
                        }
                        $class = implode(' ', $classes)
                        ?>
                        <li class="<?= $class ?>">
                            <a href="<?= $url ?>">
                                <i class="<?= $icon ?>"></i>
                                <span class="title"><?= $name ?></span>
                                <?php if ($active) { ?>
                                <span class="selected"></span>
                                <?php } ?>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
        }
        ?>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
