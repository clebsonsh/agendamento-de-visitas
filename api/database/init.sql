CREATE TABLE IF NOT EXISTS vehicles
(
    id         BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image      VARCHAR(255)                      NOT NULL,
    make       VARCHAR(255)                      NOT NULL,
    model      VARCHAR(255)                      NOT NULL,
    version    VARCHAR(255)                      NOT NULL,
    price      BIGINT UNSIGNED                   NOT NULL,
    sale_point VARCHAR(255)                      NOT NULL
);

CREATE TABLE IF NOT EXISTS schedules
(
    id           BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    vehicle_id   BIGINT                            NOT NULL,
    scheduled_at TIMESTAMP                         NOT NULL,
    CONSTRAINT fk_schedule_vehicle_id FOREIGN KEY (vehicle_id) REFERENCES vehicles (id),
    CONSTRAINT uq_schedules_vehicle_id_scheduled_at  UNIQUE (vehicle_id, scheduled_at)
);

CREATE TABLE IF NOT EXISTS visits
(
    id          BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    schedule_id BIGINT                            NOT NULL,
    name        VARCHAR(255)                      NOT NULL,
    email       VARCHAR(255)                      NOT NULL,
    phone       VARCHAR(255)                      NOT NULL,

    CONSTRAINT fk_visit_schedule_id FOREIGN KEY (schedule_id) REFERENCES schedules (id),
    CONSTRAINT uq_visit_schedule_id UNIQUE (schedule_id)
);

INSERT INTO vehicles
(id, image, make, model, version, price, sale_point)
VALUES
(1, 'https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/polo.png', 'Volkswagen', 'Polo', 'TRACK 1.0 MPI FLEX 4P MANUAL (84 cv)', 9399000, 'São Bernardo do Campo - São Paulo'),
(2, 'https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/onix.png', 'Chevrolet', 'Onix', '1.0 ASPIRADO 4P MANUAL (82 cv)', 8499000, 'Santo André - São Paulo'),
(3, 'https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/hb20.png', 'Hyundai', 'HB20', '1.0 KAPPA 4P MANUAL (80 cv)', 9519000, 'São Caetano do Sul - São Paulo');

INSERT INTO schedules (vehicle_id, scheduled_at)
VALUES
-- D0
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 13:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),


(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 13:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 0 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
-- D+1
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 13:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),

(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 1 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
-- D+2
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 13:00:00'), '%Y-%m-%d %H:%i:%s')),

(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 2 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
-- D+3
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 13:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 16:00:00'), '%Y-%m-%d %H:%i:%s')),

(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 3 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),
-- D+4
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 11:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(1, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 14:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 15:00:00'), '%Y-%m-%d %H:%i:%s')),
(2, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s')),

(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 09:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 10:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 12:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 17:00:00'), '%Y-%m-%d %H:%i:%s')),
(3, STR_TO_DATE(CONCAT(DATE_ADD(CURDATE(), INTERVAL 4 DAY), ' 18:00:00'), '%Y-%m-%d %H:%i:%s'));
