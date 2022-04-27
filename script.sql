create table user_accounts
(
    id       serial
        constraint user_accounts_pk
            primary key,
    username varchar(100)           not null,
    password varchar(100)           not null,
    salt     varchar(200) default 1 not null
);

alter table user_accounts
    owner to wknmktwtgoyhlx;

create unique index user_accounts_id_uindex
    on user_accounts (id);

create unique index user_accounts_username_uindex
    on user_accounts (username);

create table recipes
(
    id          serial
        constraint recipes_pk
            primary key,
    title       varchar(100)  not null,
    content     varchar(9192) not null,
    image       varchar(200) default 'recipe-default-image.jpg'::character varying,
    date_added  date          not null,
    rating      double precision,
    author_id   integer       not null
        constraint recipes_user_accounts_fk
            references user_accounts
            on update cascade on delete cascade,
    description varchar(400)
);

alter table recipes
    owner to wknmktwtgoyhlx;

create unique index recipes_id_uindex
    on recipes (id);

create unique index recipes_title_uindex
    on recipes (title);

create table users_data
(
    id              serial
        constraint users_data_pk
            primary key,
    name            varchar(48) not null,
    lastname        varchar(48) not null,
    email           varchar(96),
    skill_level     varchar(20),
    profile_picture varchar(200) default 'default_profile_pic.png'::character varying,
    user_account_id integer     not null
        constraint users_data_user_accounts_fk
            references user_accounts
            on update cascade on delete cascade
);

alter table users_data
    owner to wknmktwtgoyhlx;

create unique index users_data_email_uindex
    on users_data (email);

create unique index users_data_id_uindex
    on users_data (id);

create unique index users_data_user_account_id_uindex
    on users_data (user_account_id);

create table ingredients
(
    id       serial
        constraint ingredients_pk
            primary key,
    name     varchar(100) not null,
    proteins double precision,
    carbs    double precision,
    fats     double precision,
    calories double precision
);

alter table ingredients
    owner to wknmktwtgoyhlx;

create unique index ingredients_id_uindex
    on ingredients (id);

create unique index ingredients_name_uindex
    on ingredients (name);

create table recipe_ingredient
(
    recipe_id     integer not null
        constraint recipe_ingredient__recipe_fk
            references recipes
            on update cascade on delete cascade,
    ingredient_id integer not null
        constraint recipe_ingredient__ingredient_fk
            references ingredients
            on update cascade on delete cascade,
    amount        double precision
);

alter table recipe_ingredient
    owner to wknmktwtgoyhlx;

create table categories
(
    id   serial
        constraint categories_pk
            primary key,
    name varchar(256) not null
);

alter table categories
    owner to wknmktwtgoyhlx;

create unique index categories_id_uindex
    on categories (id);

create unique index categories_name_uindex
    on categories (name);

create table recipe_category
(
    recipe_id   integer not null
        constraint recipe_category__recipes_id_fk
            references recipes
            on update cascade on delete cascade,
    category_id integer not null
        constraint recipe_category__categories_id_fk
            references categories
            on update cascade on delete cascade
);

alter table recipe_category
    owner to wknmktwtgoyhlx;


