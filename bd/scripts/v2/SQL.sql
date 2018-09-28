/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     26/09/2018 23:32:37                          */
/*==============================================================*/

/*==============================================================*/
/* Domain: TIPOCATEGORIA                                        */
/*==============================================================*/
create domain TIPOCATEGORIA as CHAR(30);

/*==============================================================*/
/* Domain: TIPOESTADOMESA                                       */
/*==============================================================*/
create domain TIPOESTADOMESA as INT4;

/*==============================================================*/
/* Domain: TIPOPERSONA                                          */
/*==============================================================*/
create domain TIPOPERSONA as CHAR(30);

/*==============================================================*/
/* Domain: TIPOVENTAESTADO                                      */
/*==============================================================*/
create domain TIPOVENTAESTADO as INT4;

/*==============================================================*/
/* Table: CATEGORIAS                                            */
/*==============================================================*/
create table CATEGORIAS (
   ID                   SERIAL               not null,
   TIPO                 TIPOCATEGORIA        not null,
   constraint PK_CATEGORIAS primary key (ID)
);

/*==============================================================*/
/* Index: CATEGORIAS_PK                                         */
/*==============================================================*/
create unique index CATEGORIAS_PK on CATEGORIAS (
ID
);

/*==============================================================*/
/* Table: CAT_PERSONAS                                          */
/*==============================================================*/
create table CAT_PERSONAS (
   ID                   SERIAL               not null,
   PER_ID               INT4                 not null,
   CAT_ID               INT4                 not null,
   constraint PK_CAT_PERSONAS primary key (ID)
);

/*==============================================================*/
/* Index: CAT_PERSONAS_PK                                       */
/*==============================================================*/
create unique index CAT_PERSONAS_PK on CAT_PERSONAS (
ID
);

/*==============================================================*/
/* Index: PERSONAS___CAT_PERSONAS_FK                            */
/*==============================================================*/
create  index PERSONAS___CAT_PERSONAS_FK on CAT_PERSONAS (
PER_ID
);

/*==============================================================*/
/* Index: CATEGORIA___CAT_PERSONAS_FK                           */
/*==============================================================*/
create  index CATEGORIA___CAT_PERSONAS_FK on CAT_PERSONAS (
CAT_ID
);

/*==============================================================*/
/* Table: CAT_PRODUCTOS                                         */
/*==============================================================*/
create table CAT_PRODUCTOS (
   ID                   SERIAL               not null,
   NOMBRE               CHAR(30)             not null,
   USA_STOCK            BOOL                 not null,
   constraint PK_CAT_PRODUCTOS primary key (ID)
);

/*==============================================================*/
/* Index: CAT_PRODUCTOS_PK                                      */
/*==============================================================*/
create unique index CAT_PRODUCTOS_PK on CAT_PRODUCTOS (
ID
);

/*==============================================================*/
/* Table: COMPRAS                                               */
/*==============================================================*/
create table COMPRAS (
   ID                   SERIAL               not null,
   PROVEEDOR_ID         INT4                 not null,
   COSTO_TOTAL          INT4                 not null,
   FECHA                DATE                 not null,
   ESTADO               BOOL                 not null,
   NRO_FACTURA          CHAR(30)             not null,
   RUC                  CHAR(30)             not null,
   TIMBRADO             CHAR(30)             not null,
   constraint PK_COMPRAS primary key (ID)
);

/*==============================================================*/
/* Index: COMPRAS_PK                                            */
/*==============================================================*/
create unique index COMPRAS_PK on COMPRAS (
ID
);

/*==============================================================*/
/* Index: CAT_PERSONAS___COMPRAS_FK                             */
/*==============================================================*/
create  index CAT_PERSONAS___COMPRAS_FK on COMPRAS (
PROVEEDOR_ID
);

/*==============================================================*/
/* Table: COMPRAS_DETALLE                                       */
/*==============================================================*/
create table COMPRAS_DETALLE (
   ID                   SERIAL               not null,
   COMPRA_ID            INT4                 not null,
   PRODUCTO_ID          INT4                 not null,
   COSTO_UNITARIO       INT4                 not null,
   CANTIDAD             INT4                 not null,
   SUB_TOTAL            INT4                 not null,
   constraint PK_COMPRAS_DETALLE primary key (ID)
);

/*==============================================================*/
/* Index: COMPRAS_DETALLE_PK                                    */
/*==============================================================*/
create unique index COMPRAS_DETALLE_PK on COMPRAS_DETALLE (
ID
);

/*==============================================================*/
/* Index: COMPRAS___COMPRAS_DETALLE_FK                          */
/*==============================================================*/
create  index COMPRAS___COMPRAS_DETALLE_FK on COMPRAS_DETALLE (
COMPRA_ID
);

/*==============================================================*/
/* Index: PRODUCTOS___COMPRAS_DETALLE_FK                        */
/*==============================================================*/
create  index PRODUCTOS___COMPRAS_DETALLE_FK on COMPRAS_DETALLE (
PRODUCTO_ID
);

/*==============================================================*/
/* Table: MESAS                                                 */
/*==============================================================*/
create table MESAS (
   ID                   SERIAL               not null,
   NOMBRE               CHAR(30)             not null,
   ESTADO               TIPOESTADOMESA       not null,
   constraint PK_MESAS primary key (ID)
);

/*==============================================================*/
/* Index: MESAS_PK                                              */
/*==============================================================*/
create unique index MESAS_PK on MESAS (
ID
);

/*==============================================================*/
/* Table: PERSONAS                                              */
/*==============================================================*/
create table PERSONAS (
   ID                   SERIAL               not null,
   NOMBRE               CHAR(30)             not null,
   APELLIDO             CHAR(30)             not null,
   TELEFONO             CHAR(30)             null,
   CI_RUC               CHAR(30)             not null,
   DIRECCION            CHAR(30)             not null,
   TIPO                 TIPOPERSONA          not null,
   constraint PK_PERSONAS primary key (ID)
);

/*==============================================================*/
/* Index: PERSONAS_PK                                           */
/*==============================================================*/
create unique index PERSONAS_PK on PERSONAS (
ID
);

/*==============================================================*/
/* Table: PRODUCTOS                                             */
/*==============================================================*/
create table PRODUCTOS (
   ID                   SERIAL               not null,
   CAT_PRODUCTO_ID      INT4                 not null,
   NOMBRE               CHAR(30)             not null,
   EXISTENCIA           INT4                 not null,
   PRECIO_VENTA         INT4                 not null,
   IMAGEN               CHAR(254)            null,
   constraint PK_PRODUCTOS primary key (ID)
);

/*==============================================================*/
/* Index: PRODUCTOS_PK                                          */
/*==============================================================*/
create unique index PRODUCTOS_PK on PRODUCTOS (
ID
);

/*==============================================================*/
/* Index: CAT_PRODUCTOS___PRODUCTOS_FK                          */
/*==============================================================*/
create  index CAT_PRODUCTOS___PRODUCTOS_FK on PRODUCTOS (
CAT_PRODUCTO_ID
);

/*==============================================================*/
/* Table: VENTAS                                                */
/*==============================================================*/
create table VENTAS (
   ID                   SERIAL               not null,
   CLIENTE_ID           INT4                 not null,
   FUNCIONARIO_ID       INT4                 not null,
   MESA_ID              INT4                 not null,
   ESTADO               TIPOVENTAESTADO      not null,
   FECHA                DATE                 not null,
   constraint PK_VENTAS primary key (ID)
);

/*==============================================================*/
/* Index: VENTAS_PK                                             */
/*==============================================================*/
create unique index VENTAS_PK on VENTAS (
ID
);

/*==============================================================*/
/* Index: CAT_PERSONAS___VENTAS_2_FK                            */
/*==============================================================*/
create  index CAT_PERSONAS___VENTAS_2_FK on VENTAS (
FUNCIONARIO_ID
);

/*==============================================================*/
/* Index: CAT_PERSONAS___VENTAS_1_FK                            */
/*==============================================================*/
create  index CAT_PERSONAS___VENTAS_1_FK on VENTAS (
CLIENTE_ID
);

/*==============================================================*/
/* Index: MESAS___VENTAS_FK                                     */
/*==============================================================*/
create  index MESAS___VENTAS_FK on VENTAS (
MESA_ID
);

/*==============================================================*/
/* Table: VENTAS_DETALLE                                        */
/*==============================================================*/
create table VENTAS_DETALLE (
   ID                   SERIAL               not null,
   VENTA_ID             INT4                 not null,
   PRODUCTO_ID          INT4                 not null,
   CANTIDAD             INT4                 not null,
   PRECIO               INT4                 not null,
   SUBTOTAL             INT4                 not null,
   constraint PK_VENTAS_DETALLE primary key (ID)
);

/*==============================================================*/
/* Index: VENTAS_DETALLE_PK                                     */
/*==============================================================*/
create unique index VENTAS_DETALLE_PK on VENTAS_DETALLE (
ID
);

/*==============================================================*/
/* Index: PRODUCTOS___VENTAS_DETALLE_FK                         */
/*==============================================================*/
create  index PRODUCTOS___VENTAS_DETALLE_FK on VENTAS_DETALLE (
PRODUCTO_ID
);

/*==============================================================*/
/* Index: VENTAS___VENTAS_DETALLE_FK                            */
/*==============================================================*/
create  index VENTAS___VENTAS_DETALLE_FK on VENTAS_DETALLE (
VENTA_ID
);

alter table CAT_PERSONAS
   add constraint FK_CAT_PERS_CATEGORIA_CATEGORI foreign key (CAT_ID)
      references CATEGORIAS (ID)
      on delete restrict on update restrict;

alter table CAT_PERSONAS
   add constraint FK_CAT_PERS_PERSONAS__PERSONAS foreign key (PER_ID)
      references PERSONAS (ID)
      on delete restrict on update restrict;

alter table COMPRAS
   add constraint FK_COMPRAS_CAT_PERSO_CAT_PERS foreign key (PROVEEDOR_ID)
      references CAT_PERSONAS (ID)
      on delete restrict on update restrict;

alter table COMPRAS_DETALLE
   add constraint FK_COMPRAS__COMPRAS___COMPRAS foreign key (COMPRA_ID)
      references COMPRAS (ID)
      on delete restrict on update restrict;

alter table COMPRAS_DETALLE
   add constraint FK_COMPRAS__PRODUCTOS_PRODUCTO foreign key (PRODUCTO_ID)
      references PRODUCTOS (ID)
      on delete restrict on update restrict;

alter table PRODUCTOS
   add constraint FK_PRODUCTO_CAT_PRODU_CAT_PROD foreign key (CAT_PRODUCTO_ID)
      references CAT_PRODUCTOS (ID)
      on delete restrict on update restrict;

alter table VENTAS
   add constraint FK_VENTAS_CAT_PERSO_CAT_CLIENTE foreign key (CLIENTE_ID)
      references CAT_PERSONAS (ID)
      on delete restrict on update restrict;

alter table VENTAS
   add constraint FK_VENTAS_CAT_PERSO_CAT_FUNCIO foreign key (FUNCIONARIO_ID)
      references CAT_PERSONAS (ID)
      on delete restrict on update restrict;

alter table VENTAS
   add constraint FK_VENTAS_MESAS___V_MESAS foreign key (MESA_ID)
      references MESAS (ID)
      on delete restrict on update restrict;

alter table VENTAS_DETALLE
   add constraint FK_VENTAS_D_PRODUCTOS_PRODUCTO foreign key (PRODUCTO_ID)
      references PRODUCTOS (ID)
      on delete restrict on update restrict;

alter table VENTAS_DETALLE
   add constraint FK_VENTAS_D_VENTAS____VENTAS foreign key (VENTA_ID)
      references VENTAS (ID)
      on delete restrict on update restrict;

