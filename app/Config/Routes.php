<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing & Otentikasi Demo
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/login/demo', 'Auth::demoLogin');
$routes->get('/login/demo-siswa', 'Auth::demoLoginStudent');
$routes->get('/switch-role/(:segment)', 'Auth::switchRole/$1');
$routes->get('/logout', 'Auth::logout');
$routes->get('/reset-demo', 'Auth::resetDemo');

// Dashboard Guru / Admin
$routes->get('/dashboard', 'Dashboard::index');

// Fitur 1: Scan QR (Dynamic & Kamera Scanner)
$routes->get('/scan-qr', 'Presensi::index');
$routes->post('/scan-qr/process', 'Presensi::process');
$routes->post('/scan-qr/simulate', 'Presensi::simulate');

// Fitur 2: Jurnal KBM Digital
$routes->get('/jurnal-kbm', 'Jurnal::index');
$routes->post('/jurnal-kbm/store', 'Jurnal::store');

// Fitur 3: Notifikasi Real-Time Orang Tua/Wali (WhatsApp Gateway)
$routes->get('/notifikasi', 'Notifikasi::index');
$routes->post('/notifikasi/test-send', 'Notifikasi::testSend');

// Fitur 4: Rekapitulasi Web & Ekspor Laporan
$routes->get('/rekapitulasi', 'Rekapitulasi::index');

// Portal Khusus Siswa
$routes->get('/siswa', 'Siswa::index');
$routes->post('/siswa/scan-class', 'Siswa::scanClass');
