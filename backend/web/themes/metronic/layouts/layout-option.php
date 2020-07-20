<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler"></div>
    <div class="toggler-close"></div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <div class="row">
                <div class="col-md-12">
                    <span class="pull-left"> THEME COLOR </span>
                    <a title="Reset" class="pull-right" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['system/setting/reset-layout-configuration']); ?>"><i class="glyphicon glyphicon-refresh "></i></a>
                </div>
             </div>
            <ul>
                <li class="color-default current tooltips" data-style="default"
                    data-container="body" data-original-title="Default"></li>
                <li class="color-darkblue tooltips" data-style="darkblue" data-container="body"
                    data-original-title="Dark Blue"></li>
                <li class="color-blue tooltips" data-style="blue" data-container="body"
                    data-original-title="Blue"></li>
                <li class="color-grey tooltips" data-style="grey" data-container="body"
                    data-original-title="Grey"></li>
                <li class="color-light tooltips" data-style="light" data-container="body"
                    data-original-title="Light"></li>
                <li class="color-light2 tooltips" data-style="light2" data-container="body"
                    data-html="true" data-original-title="Light 2"></li>
            </ul>
        </div>
        <?php /*
        <div class="theme-option">
            <span> Theme Style </span>
            <select class="layout-style-option form-control input-sm">
                <option value="square" <?= $this->params['themeStyle'] == "square" ? 'selected = "selected"' : '' ?>>Square corners</option>
                <option value="rounded" <?= $this->params['themeStyle'] == "rounded" ? 'selected = "selected"' : '' ?>>Rounded corners</option>
                <option value="md" <?= $this->params['themeStyle'] == "md" ? 'selected = "selected"' : '' ?>>Material design</option>
            </select>
        </div>
        */ ?>
        <div class="theme-option">
            <span> Layout </span>
            <select class="layout-option form-control input-sm">
                <option value="fluid" <?= $this->params['layoutStyle'] == "fluid" ? 'selected="selected"' : "" ?>>Fluid</option>
                <option value="boxed" <?= $this->params['layoutStyle'] == "boxed" ? 'selected="selected"' : "" ?>>Boxed</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Header </span>
            <select class="page-header-option form-control input-sm">
                <option value="fixed" <?= $this->params['headerStyle'] == "fixed" ? 'selected="selected"' : "" ?>>Fixed</option>
                <option value="default" <?= $this->params['headerStyle'] == "default" ? 'selected="selected"' : "" ?>>Default</option>
            </select>
        </div>
        <?php /*
        //not use
        <div class="theme-option">
            <span> Top Menu Dropdown</span>
            <select class="page-header-top-dropdown-style-option form-control input-sm">
                <option value="light" <?= $this->params['dropdownStyle'] == "light" ? 'selected="selected"' : "" ?>>Light</option>
                <option value="dark" <?= $this->params['dropdownStyle'] == "dark" ? 'selected="selected"' : "" ?>>Dark</option>
            </select>
        </div>
        //can not make it works at default set, works on change option
        <div class="theme-option">
            <span> Sidebar Mode</span>
            <select class="sidebar-option form-control input-sm">
                <option value="fixed" <?= $this->params['sidebarMode'] == "fixed" ? 'selected="selected"' : "" ?>>Fixed</option>
                <option value="default" <?= $this->params['sidebarMode'] == "default" ? 'selected="selected"' : "" ?>>Default</option>
            </select>
        </div>
        //not good
        <div class="theme-option">
            <span> Sidebar Menu </span>
            <select class="sidebar-menu-option form-control input-sm">
                <option value="accordion" selected="selected">Accordion</option>
                <option value="hover">Hover</option>
            </select>
        </div>
        */ ?>
        <div class="theme-option">
            <span> Sidebar Style </span>
            <select class="sidebar-style-option form-control input-sm">
                <option value="default" <?= $this->params['sidebarStyle'] == "default" ? 'selected="selected"' : "" ?>>Default</option>
                <option value="light" <?= $this->params['sidebarStyle'] == "light" ? 'selected="selected"' : "" ?>>Light</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Sidebar Position </span>
            <select class="sidebar-pos-option form-control input-sm">
                <option value="left" <?= $this->params['sidebarPosition'] == "left" ? 'selected="selected"' : "" ?>>Left</option>
                <option value="right" <?= $this->params['sidebarPosition'] == "right" ? 'selected="selected"' : "" ?>>Right</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Footer </span>
            <select class="page-footer-option form-control input-sm">
                <option value="fixed" <?= $this->params['footerStyle'] == "fixed" ? 'selected="selected"' : "" ?>>Fixed</option>
                <option value="default" <?= $this->params['footerStyle'] == "default" ? 'selected="selected"' : "" ?>>Default</option>
            </select>
        </div>
    </div>
</div>