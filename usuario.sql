CREATE TABLE `Usuario` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `Usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
