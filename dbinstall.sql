START TRANSACTION;

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `question` mediumtext NOT NULL,
  `answered` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `transactions` (
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_amount` int(11) NOT NULL DEFAULT 10,
  `method` char(25) DEFAULT 'TARJETA DEBITO/CREDITO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isadmin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `s3url` mediumtext NOT NULL,
  `type` char(10) NOT NULL DEFAULT 'REVIEW',
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`userid`,`date`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

INSERT INTO users (name, surname, email, password, isadmin) VALUES ("GlobalAdmin", "CARS", "superadmin@cars.local", "$2y$10$tD13eX4u38vhnS9EJoM9Aey5Fc5NQy.qdx8eCG32UcWaJ6qZC9pLa", 1)
