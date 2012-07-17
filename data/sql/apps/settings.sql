
/*============================================================================*/
/* Registro del paquete                                                       */
/*============================================================================*/
INSERT INTO `package`
(`label`, `url`, `type`, `parent`, `tsregister`, `description`)
VALUES
('settings', 'settings', 'app', 'users', UNIX_TIMESTAMP(), 'Modulo para la configuracion de usuario en el sistema');

/*============================================================================*/
/* Registro de paginas para el paquete                                        */
/*============================================================================*/
INSERT INTO `page`
(`label`, `title`, `menuable`, `package`, `controller`, `action`, `privilege`, `route`)
VALUES
('Preferencias de usuario', '', FALSE, 'settings', 'index', 'index', '', 'settings');

/*============================================================================*/
/* Registro de rutas para el paquete                                          */
/*============================================================================*/
INSERT INTO `route`
(`label`, `type`, `parent`, `route`, `mapping`, `module`, `controller`, `action`)
VALUES
('Preferencias de usuario', 'view', 'base', 'settings', 'settings', 'settings', 'index', 'index');
