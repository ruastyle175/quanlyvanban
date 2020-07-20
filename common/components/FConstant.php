<?php

namespace common\components;


class FConstant
{
    const MODE_ROLE_BAC = 'ROLE_BAC'; //ROLE BASE ACCESS CONTROL
    const MODE_RIGHT_BAC = 'RIGHT_BAC'; //RIGHT BASE ACCESS CONTROL

    const GLOBAL_ACCESS_CONTROL_MODE = self::MODE_RIGHT_BAC;

    const CONFIG_DB = 'db';

    const
        ACTION_DELETE = 'delete',
        ACTION_EDIT = 'edit',
        ACTION_ADD = 'add',
        ACTION_REJECT = 'reject',
        ACTION_APPROVED = 'approve',
        ACTION_VIEW = 'view',
        ACTION_SAVE = 'save',
        ACTION_LOAD = 'load',
        ACTION_SEND = 'send';
    const
        ACTION_DETAIL = 'detail',
        ACTION_FINISH = 'finish',
        ACTION_DENY = 'deny',
        ACTION_CANCEL = 'cancel',
        ACTION_DEAL = 'deal',
        ACTION_PAY = 'pay',
        ACTION_CREATE = 'create',
        ACTION_UPDATE = 'update';

    const RENDER_TYPE_CODE = 'code';
    const RENDER_TYPE_AUTO = 'auto';
    const RENDER_TYPE_DB_SETTING = 'database';

    const EDIT_TYPE_INLINE = 'inline',
        EDIT_TYPE_POPUP = 'popup',
        EDIT_TYPE_VIEW = 'view',
        EDIT_TYPE_DEFAULT = 'default',
        EDIT_TYPE_INPUT = 'input';

    const
        LAYOUT_ONELINE = 'one_line',
        LAYOUT_NEWLINE = 'new_line',
        LAYOUT_ONELINE_RIGHT = 'one_line_right',
        LAYOUT_TEXT = 'text',
        LAYOUT_NO_LABEL = 'nolabel',
        LAYOUT_TABLE = 'table';

    const
        NULL_VALUE = '...',
        ACTIVE_VALUE = 1,
        INACTIVE_VALUE = 0;

    const
        CHANGE_TYPE = 'change',
        CLEAR_TYPE = 'clear',
        FILL_TYPE = 'fill',
        SUBMIT_TYPE = 'submit';
    const
        BUTTON_CREATE = 'create',
        BUTTON_UPDATE = 'update',
        BUTTON_DELETE = 'delete',
        BUTTON_PROCESS = 'processing',
        BUTTON_PENDING = 'pending',
        BUTTON_RESET = 'reset',
        BUTTON_SEARCH = 'search',
        BUTTON_EDIT = 'edit',
        BUTTON_CANCEL = 'cancel',
        BUTTON_ADD = 'add',
        BUTTON_REMOVE = 'remove',
        BUTTON_SELECT = 'select',
        BUTTON_MOVE = 'move',
        BUTTON_RELOAD = 'reload',
        BUTTON_OK = 'ok',
        BUTTON_COPY = 'copy',
        BUTTON_ACCEPT = 'accept',
        BUTTON_REJECT = 'reject',
        BUTTON_APPROVE = 'approve',
        BUTTON_APPROVED = 'approved',
        BUTTON_BACK = 'back',
        BUTTON_READ = 'read',
        BUTTON_UNREAD = 'unread',
        BUTTON_CONFIRM = 'confirm',
        BUTTON_COMPLETE = 'complete',
        BUTTON_REVERT = 'revert',
        BUTTON_SEND = 'send';

    public static $buttonIcons = array(
        self::BUTTON_CREATE => 'fa fa-plus',
        self::BUTTON_SEARCH => 'fa fa-search',
        self::BUTTON_APPROVE => 'fa fa-check',
        self::BUTTON_UPDATE => 'fa fa-save',
        self::BUTTON_DELETE => 'fa fa-trash',
        self::BUTTON_RESET => 'fa fa-refresh',
        self::BUTTON_EDIT => 'fa fa-pencil',
        self::BUTTON_CANCEL => 'fa fa-cancel',
        self::BUTTON_COPY => 'fa fa-copy',
        self::BUTTON_ADD => 'fa fa-plus',
        self::BUTTON_REMOVE => 'fa fa-trash',
        self::BUTTON_SELECT => 'fa fa-share',
        self::BUTTON_MOVE => 'fa fa-move',
        self::BUTTON_OK => 'fa fa-ok',
        self::BUTTON_ACCEPT => 'fa fa-plus',
        self::BUTTON_REJECT => 'fa fa-lock',
        self::BUTTON_APPROVED => 'fa fa-ok-sign',
        self::BUTTON_BACK => 'fa fa-arrow-left',
        self::BUTTON_READ => 'fa fa-bookmark',
        self::BUTTON_UNREAD => 'fa fa-bookmark',
        self::BUTTON_CONFIRM => 'fa fa-signin',
        self::BUTTON_COMPLETE => 'fa fa-remove',
        self::BUTTON_REVERT => 'fa fa-share',
        self::BUTTON_SEND => 'm-fa fa-swapright',
        self::BUTTON_PROCESS => 'fa fa-play',
        self::BUTTON_PENDING => 'fa fa-pause',
    );
    //Configuration
    const
        ADMIN_EMAIL = 'ADMIN_EMAIL',
        SUPPORT_EMAIL = 'SUPPORT_EMAIL',
        GOOGLE_API_KEY = 'GOOGLE_API_KEY',
        GOOGLE_MAP_API_KEY = 'GOOGLE_MAP_API_KEY',
        PEM_FILE = 'PEM_FILE',
        COMPANY_NAME = 'COMPANY_NAME',
        COMPANY_DESCRIPTION = 'COMPANY_DESCRIPTION',
        COMPANY_HOMEPAGE = 'COMPANY_HOMEPAGE',
        LAYOUT_CONFIGURATION = 'LAYOUT_CONFIGURATION',
        FRONTEND_LAYOUT_CONFIGURATION = 'FRONTEND_LAYOUT_CONFIGURATION',

        //game module
        LINK_FACEBOOK = 'LINK_FACEBOOK',
        HOTLINE = 'HOTLINE',
        HOTLINE_BRAND = 'HOTLINE_BRAND',
        HOTLINE_APP = 'HOTLINE_APP',
        LINK_TRY = 'LINK_TRY',
        LINK_PLAY = 'LINK_PLAY',
        LINK_REGISTER = 'LINK_REGISTER',
        LINK_LIVE_SUPPORT = 'LINK_LIVE_SUPPORT',
        ENABLE_FAKE_DATA = 'ENABLE_FAKE_DATA',

        SUCCESS = 'SUCCESS',
        ERROR = 'ERROR',
        STATUS_ACTIVE = '1',
        STATUS_INACTIVE = '0',
        MISSING_PARAMS = 'Missing parameters',
        MISMATCH_PARAMS = 'Params mismatch',
        STATE_ACTIVE = 1,
        STATE_INACTIVE = 0,
        STATE_DELETED = -1;

    const
        TYPE_ANDROID = 1,
        TYPE_IOS = 2,
        NO_IMAGE = 'no_image.png',
        NO_IMAGE_JPG = 'no_image.jpg';
    const
        FRONTEND_THEME_AHA = 'aha',
        FRONTEND_THEME_ZORKA = 'zorka',
        DEFAULT_ITEMS_PER_PAGE = 10;
    const
        WIDGET_COLOR_DEFAULT = "default",
        WIDGET_TYPE_DEFAULT = "light bordered",
        WIDGET_TYPE_BOX = "box",
        WIDGET_TYPE_NONE = "light", // light, light bordered, box
        WIDGET_TYPE_LIGHT = "light bordered";

    const
        LABEL_ACTIVE = 'active',
        LABEL_INACTIVE = 'inactive',
        LABEL_NEW = 'new',
        LABEL_NORMAL = 'normal',
        LABEL_PREMIUM = 'premium',
        LABEL_OLD = 'old';

    const
        UPLOAD_FAIL = 'Upload fail';
    const
        DEFAULT_AVATAR = 'default_avatar.jpg';
    const

        STATUS_PUBLISH = 'publish',
        STATUS_DRAFT = 'draft',
        DEVICE_TYPE_ANDROID = 1,
        DEVICE_TYPE_IOS = 2,

        PAYMENT_STATUS_PAID = 1,//'paid'
        PAYMENT_STATUS_PENDING = 0;//'pending'

    const
        STATUS_FAIL = 'fail',
        STATUS_APPROVED = 'approved',
        STATUS_REJECTED = 'rejected',
        STATUS_PROCESSING = 'processing',
        STATUS_FINISH = 'finish',
        STATUS_PENDING = 'pending';

    const
        EMAIL_OR_USERNAME_EXIST = 'Email or username existed',
        EMAIL_EXIST = 'Email exist',
        EMAIL_DOES_NOT_EXIST = 'Email does not exist',
        EMAIL_OR_USERNAME_DOES_NOT_EXIST = 'Email or username does not exist',
        WRONG_PASSWORD = 'Wrong password',
        USER_NOT_FOUND = 'User not found',
        DATA_NOT_FOUND = 'Data not found',
        TOKEN_MISMATCH = 'Token mismatch',
        CAN_NOT_PERFORM = 'You can not perform this action';
}