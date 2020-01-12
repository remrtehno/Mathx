<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model {
		//ALTER TABLE `users` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);

    // `updated_at`, `created_at` DISABLE
		public $timestamps = false;
}
