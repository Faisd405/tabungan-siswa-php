-- Seeder untuk tabel users
INSERT INTO `users` (`username`, `password`, `role`, `created_at`, `updated_at`) VALUES
('admin', '$2y$10$Tkh8ztlZ/gfR8.wgvzA9cO2n8eJ1.jfNyD1eY/WiZOl/HX0CKB12m', 'admin', NOW(), NOW()), -- Password: admin123
('staff1', '$2y$10$uwMvXKoN1uc/Kl6uR8QHneQDXpuHRbkM7M5B7.t1lUlJ.y6b/VTeG', 'staff', NOW(), NOW()), -- Password: staff123
('siswa1', '$2y$10$kmjUzZCQYKPqf93HUZcFDeP8n2uHqT9hXm4ptEtpeB5.M8/MdkM4m', 'siswa', NOW(), NOW()); -- Password: siswa123

-- Seeder untuk tabel students
INSERT INTO `students` (`user_id`, `nis`, `name`, `class`, `date_of_birth`, `address`, `parent_name`, `created_at`, `updated_at`) VALUES
(3, '202201001', 'Budi Santoso', '10A', '2007-05-15', 'Jl. Mawar No. 10', 'Sutrisno', NOW(), NOW()),
(NULL, '202201002', 'Ani Wijaya', '10B', '2007-08-21', 'Jl. Melati No. 20', 'Suwarno', NOW(), NOW());

-- Seeder untuk tabel savings_accounts
INSERT INTO `savings_accounts` (`student_id`, `account_number`, `balance`, `created_at`, `updated_at`) VALUES
(1, 'SA001', 100000.00, NOW(), NOW()),
(2, 'SA002', 50000.00, NOW(), NOW());

-- Seeder untuk tabel transactions
INSERT INTO `transactions` (`account_id`, `transaction_type`, `amount`, `transaction_date`, `staff_id`, `created_at`, `updated_at`) VALUES
(1, 'deposit', 50000.00, NOW(), 2, NOW(), NOW()),
(1, 'withdrawal', 10000.00, NOW(), 2, NOW(), NOW()),
(2, 'deposit', 25000.00, NOW(), 2, NOW(), NOW()),
(2, 'withdrawal', 5000.00, NOW(), 2, NOW(), NOW());
