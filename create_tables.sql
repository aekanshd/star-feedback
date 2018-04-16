CREATE TABLE `ratings` (
 `rating_id` int(11) NOT NULL AUTO_INCREMENT,
 `rating` int(5) NOT NULL,
 `feedback` text,
 `by_user` int(11) NOT NULL,
 PRIMARY KEY (`rating_id`),
 KEY `by_user` (`by_user`),
 CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`by_user`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;