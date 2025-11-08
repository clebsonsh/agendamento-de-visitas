CREATE TABLE IF NOT EXISTS vehicles
(
    id         BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image      VARCHAR(255)                      NOT NULL,
    make       VARCHAR(255)                      NOT NULL,
    model      VARCHAR(255)                      NOT NULL,
    version    VARCHAR(255)                      NOT NULL,
    price      BIGINT UNSIGNED                   NOT NULL,
    sale_point VARCHAR(255)                      NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS schedules
(
    id           BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    vehicle_id   BIGINT                            NOT NULL,
    scheduled_at TIMESTAMP                         NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_schedule_vehicle_id FOREIGN KEY (vehicle_id) REFERENCES vehicles (id)
);

CREATE TABLE IF NOT EXISTS visits
(
    id          BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    schedule_id BIGINT                            NOT NULL,
    name        VARCHAR(255)                      NOT NULL,
    email       VARCHAR(255)                      NOT NULL,
    phone       VARCHAR(255)                      NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_visit_schedule_id FOREIGN KEY (schedule_id) REFERENCES schedules (id),
    CONSTRAINT uq_visit_schedule_id UNIQUE (schedule_id)
);

INSERT INTO vehicles
(image, make, model, version, price, sale_point)
VALUES
('https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/polo.png', 'Volkswagen', 'Polo', 'Track 1.0 MPI', 9399000, 'São Bernardo do Campo - São Paulo'),
('https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/onix.png', 'Chevrolet', 'Onix', '1.0 MT', 8499000, 'Santo André - São Paulo'),
('https://raw.githubusercontent.com/clebsonsh/agendamento-de-visitas/refs/heads/main/assets/hb20.png', 'Hyundai', 'HB20', '1.0 MT (Sense Plus)', 9519000, 'São Caetano do Sul - São Paulo');
