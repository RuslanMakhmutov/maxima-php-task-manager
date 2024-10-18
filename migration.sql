--postgres

-- CREATE DATABASE maxima_task_manager;

CREATE TABLE public.roles (
	id smallserial NOT NULL,
	created_at timestamp NOT NULL,
	"name" varchar NOT NULL,
	CONSTRAINT role_pk PRIMARY KEY (id),
	CONSTRAINT role_unique UNIQUE ("name")
);
CREATE INDEX role_id_idx ON public.roles (id);
COMMENT ON TABLE public.roles IS 'Роли';
COMMENT ON COLUMN public.roles.created_at IS 'дата создания';


CREATE TABLE public.users (
	id bigserial NOT NULL,
	created_at timestamp NOT NULL,
	"name" varchar NOT NULL,
	email varchar NOT NULL,
	"password" varchar NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY (id),
	CONSTRAINT users_unique UNIQUE (email)
);
COMMENT ON TABLE public.users IS 'Пользователи';
COMMENT ON COLUMN public.users.created_at IS 'дата создания';
COMMENT ON COLUMN public.users."name" IS 'Имя';
COMMENT ON COLUMN public.users.email IS 'E-mail';
COMMENT ON COLUMN public.users."password" IS 'хеш пароля';


CREATE TABLE public.role_user (
	role_id smallint NOT NULL,
	user_id bigint NOT NULL,
	CONSTRAINT role_user_users_fk FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE,
	CONSTRAINT role_user_role_fk FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE
);
CREATE UNIQUE INDEX role_user_unique ON public.role_user (role_id,user_id);
CREATE INDEX role_user_role_id_idx ON public.role_user (role_id);
CREATE INDEX role_user_user_id_idx ON public.role_user (user_id);
COMMENT ON TABLE public.role_user IS 'Роли пользователей';
COMMENT ON COLUMN public.role_user.role_id IS 'id роли';
COMMENT ON COLUMN public.role_user.user_id IS 'id пользователя';



CREATE TABLE public.tasks (
	id bigserial NOT NULL,
	created_at timestamp NOT NULL,
	title varchar NOT NULL,
	user_id bigint NOT NULL,
	parent_id bigint NULL,
	deadline timestamp NULL,
	finished_at timestamp NULL,
	CONSTRAINT tasks_pk PRIMARY KEY (id),
	CONSTRAINT tasks_users_fk FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE
);
CREATE INDEX tasks_parent_id_idx ON public.tasks (parent_id);
CREATE INDEX tasks_user_id_idx ON public.tasks (user_id);
COMMENT ON TABLE public.tasks IS 'Задачи';
COMMENT ON COLUMN public.tasks.created_at IS 'дата создания';
COMMENT ON COLUMN public.tasks.title IS 'Название задачи';
COMMENT ON COLUMN public.tasks.user_id IS 'id автора (пользователя)';
COMMENT ON COLUMN public.tasks.parent_id IS 'id родительской задачи';
COMMENT ON COLUMN public.tasks.deadline IS 'срок выполнения';
COMMENT ON COLUMN public.tasks.finished_at IS 'дата завершения';

ALTER TABLE public.tasks ADD CONSTRAINT tasks_tasks_fk FOREIGN KEY (parent_id) REFERENCES public.tasks(id) ON DELETE CASCADE;
