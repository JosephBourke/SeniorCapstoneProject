INSERT INTO user (username, password, uid) VALUES
('wert1728', 'MONmon19$', 2536471),
('gert1924', 'GIGtime21%', 4673920),
('ghet1928', 'TALtal31&', 5261822),
('newt1923', 'BIGsmall22#', 5362891),
('seng1927', 'COMteach60$', 9876534);

INSERT INTO request (id, create_time, description, accepted, user_id, equipment_id) 
VALUES 
(1234567, '2025-02-18 10:30:00', 'Request for specific Sony camera.', 1, 2536471, 12),
(4567890, '2025-02-18 11:00:00', 'Request for Super-Special camera.', 0, 4673920, 15),
(5673839, '2025-02-18 11:30:00', 'Request for less special camera.', 1, 5261822, 9),
(2839178, '2025-02-18 12:00:00', 'Request for insanely expensive camera.', 0, 5362891, 18),
(9876544, '2025-02-18 12:30:00', 'Request for super cheap camera.', 1, 9876534, 20);

select * from request;