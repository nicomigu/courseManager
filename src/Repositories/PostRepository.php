<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Post.php';

use src\Models\Post;

class PostRepository extends Repository {

	/**
	 * @param int $user_id
	 * @return array
	 */
	public function getPostsForUser(int $user_id): array {
		$sqlStatement = $this->mysqlConnection->prepare("SELECT id, title, body, author_id FROM posts WHERE author_id = ?");
		$sqlStatement->bind_param('i', $user_id);
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();

		$posts = [];
		while ($row = $resultSet->fetch_assoc()) {
			$posts[] = new Post($row);
		}

		return $posts;
	}

	/**
	 * @param string $title
	 * @param string $body
	 * @param int $user_id
	 * @return bool
	 */
	public function savePost(string $title, string $body, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("INSERT INTO posts VALUES(NULL, ?, ?, ?)");
		$sqlStatement->bind_param('ssi', $title, $body, $user_id);
		return $sqlStatement->execute();
	}

}
