<?php
$config = array(
			'user-student' => array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|is_unique[users.email]'
				),
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|alpha_numeric|min_length[3]|max_length[50]|is_unique[users.username]'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|min_length[8]'
				),
				array(
					'field' => 'student_id',
					'label' => 'Student Id',
					'rules' => 'required|integer'
					)
			),
			'user-trainer' => array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|is_unique[users.email]'
				),
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|alpha_numeric|min_length[3]|max_length[50]|is_unique[users.username]'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|min_length[8]'
				)
			),
			'profile' => array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|is_unique[users.email]'
					),
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|alpha_numeric|min_length[3]|max_length[50]|is_unique[users.username]'
					),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|min_length[8]'
					),
				array(
					'field' => 'password_confirmation',
					'label' => 'Password Confirmation',
					'rules' => 'required|matches[password]'
					)

				)
		);