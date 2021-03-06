
/*============================================================================*/
/* Registro de tablas imprescindibles para el manejo del sistema              */
/*============================================================================*/

/*============================================================================*/
/* Tablas requeridas para el registro de paquetes                             */
/*============================================================================*/
CREATE TABLE IF NOT EXISTS `package` (
    `ident`       int unsigned                          NOT NULL auto_increment,
    `label`       varchar(64)                           NOT NULL,
    `url`         varchar(64)                           NOT NULL,
    `status`      enum('active', 'inactive')            NOT NULL DEFAULT 'active',
    `type`        enum('base', 'middle', 'app', 'util') NOT NULL,
    `description` text                                  NOT NULL DEFAULT '',
    `tsregister`  int unsigned                          NOT NULL,
    `parent`      varchar(64)                           NULL,
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`label`),
    UNIQUE INDEX (`url`),
    INDEX (`parent`),
    FOREIGN KEY (`parent`) REFERENCES `package`(`url`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

/*============================================================================*/
/* Tablas necesarias para el registro de privilegios                          */
/*============================================================================*/
CREATE TABLE IF NOT EXISTS `privilege` (
    `ident`       int unsigned NOT NULL auto_increment,
    `label`       varchar(64)  NOT NULL,
    `package`     varchar(64)  NOT NULL,
    `description` text         NOT NULL DEFAULT '',
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`package`, `label`)
) DEFAULT CHARACTER SET UTF8;

/*============================================================================*/
/* Tabla necesaria para el manejo de rutas en el sistema                      */
/*============================================================================*/
CREATE TABLE IF NOT EXISTS `route` (
    `ident`       int unsigned                     NOT NULL auto_increment,
    `label`       varchar(64)                      NOT NULL,
    `type`        enum('list', 'view', 'action')   NOT NULL,
    `route`       varchar(64)                      NOT NULL,
    `mapping`     varchar(128)                     NOT NULL,
    `module`      varchar(64)                      NOT NULL,
    `controller`  varchar(64)                      NOT NULL,
    `action`      varchar(64)                      NOT NULL,
    `parent`      varchar(64)                      NULL DEFAULT '',
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`route`),
    UNIQUE INDEX (`mapping`),
    INDEX (`parent`),
    FOREIGN KEY (`parent`) REFERENCES `route`(`route`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS `route_privilege` (
    `route`     varchar(64) NOT NULL,
    `package`   varchar(64) NOT NULL,
    `privilege` varchar(64) NOT NULL,
    PRIMARY KEY (`route`, `package`, `privilege`),
    INDEX (`package`, `privilege`),
    FOREIGN KEY (`package`, `privilege`) REFERENCES `privilege`(`package`, `label`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS `route_menu` (
    `route` varchar(64)               NOT NULL,
    `label` varchar(64)               NOT NULL DEFAULT '',
    `type`  enum('menubar', 'footer') NOT NULL,
    `order` int unsigned              NOT NULL DEFAULT 0,
    PRIMARY KEY (`route`),
    FOREIGN KEY (`route`) REFERENCES `route`(`route`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

/*============================================================================*/
/* Tablas necesarias para el registro de manejadores de widgets               */
/*============================================================================*/
CREATE TABLE IF NOT EXISTS `widget` (
    `ident`             int unsigned                                                NOT NULL auto_increment,
    `label`             varchar(64)                                                 NOT NULL,
    `title`             varchar(32)                                                 NOT NULL,
    `package`           varchar(32)                                                 NOT NULL,
    `script`            varchar(32)                                                 NOT NULL,
    PRIMARY KEY (`ident`),
    UNIQUE INDEX (`package`, `script`)
) DEFAULT CHARACTER SET UTF8;

CREATE TABLE IF NOT EXISTS `widget_route` (
    `route`             varchar(64)                                                 NOT NULL,
    `widget`            int unsigned                                                NOT NULL,
    `position`          enum('1', '2', '3', '4')                                    NOT NULL DEFAULT '1',
    PRIMARY KEY (`route`, `widget`, `position`),
    INDEX (`route`),
    FOREIGN KEY (`route`) REFERENCES `route`(`route`) ON UPDATE CASCADE ON DELETE RESTRICT,
    INDEX (`widget`),
    FOREIGN KEY (`widget`) REFERENCES `widget`(`ident`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET UTF8;

/*============================================================================*/
/* Registro del paquete                                                       */
/*============================================================================*/
INSERT INTO `package`
(`label`, `url`, `type`, `parent`, `tsregister`, `description`)
VALUES
('base', 'base', 'base', NULL, UNIX_TIMESTAMP(), 'Paquete gestor de pagina principal');

/*============================================================================*/
/* Registro de rutas para el paquete                                          */
/*============================================================================*/
INSERT INTO `route`
(`label`, `type`, `parent`, `route`, `mapping`, `module`, `controller`, `action`)
VALUES
('Inicio',                 'list',   null,   'base',                '',              'base', 'index',  'index'),
('Inicio',                 'list',   null,   'base_visitor',        'visitor',       'base', 'index',  'visitor'),
('Inicio',                 'list',   null,   'base_user',           'user',          'base', 'index',  'user'),
('Error',                  'view',   'base', 'base_error',          'error',         'base', 'error',   'error'),
('Confirmación',           'view',   'base', 'base_confirm',        'confirm',       'base', 'index',  'confirm'),
('Colabora',               'view',   'base', 'base_development',    'development',   'base', 'static', 'development'),
('Terminos de uso',        'view',   'base', 'base_terms',          'terms',         'base', 'static', 'terms'),
('Politica de privacidad', 'view',   'base', 'base_privacy',        'privacy',       'base', 'static', 'privacy'),
('',                       'action', 'base', 'base_space_selector', 'filter_spaces', 'base', 'index',  'spaces');

/*============================================================================*/
/* Registro de recursos para la pagina principal                              */
/*============================================================================*/

/*============================================================================*/
/* Registro del paquete                                                       */
/*============================================================================*
INSERT INTO `package`
(`label`, `url`, `type`, `parent`, `tsregister`, `description`)
VALUES
('base', 'base', 'middle', 'spaces', UNIX_TIMESTAMP(), 'Modulo manejador de la pagina de inicio');

/*============================================================================*/
/* Registro de paginas para el paquete                                        */
/*============================================================================*
INSERT INTO `page`
(`label`, `title`, `menuable`, `package`, `controller`, `action`, `route`)
VALUES
('Pagina inicial',         'Inicio',          TRUE,  'base', 'index',  'visitor',     'base_visitor'),
('Pagina de usuario',      '',                FALSE, 'base', 'index',  'user',        'base_user'),
('Pagina 404',             '',                FALSE, 'base', 'error',  'error',       'default'),
('Colabora',               'Desarrollo',      TRUE,  'base', 'static', 'development', 'base_development'),
('Terminos de uso',        'Terminos de uso', TRUE,  'base', 'static', 'terms',       'base_terms'),
('Politica de privacidad', 'Privacidad',      TRUE,  'base', 'static', 'privacy',     'base_privacy');

/*============================================================================*/
/* Registro de widgets para el paquete                                        */
/*============================================================================*/
INSERT INTO `widget`
(`label`, `title`, `package`, `script`)
VALUES
('Espacios Disponibles', 'Espacios Disponibles', 'base', 'context');
