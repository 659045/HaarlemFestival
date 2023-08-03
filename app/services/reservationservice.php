<?php
require __DIR__ . '/../repositories/reservationRepository.php';
require_once __DIR__ . '/../models/reservation.php';
class ReservationService
{
    public function get_AllReservations(): array
    {
        $repo = new ReservationRepository();
        return $repo->get_AllReservations();
    }

    public function get_ReservationById($uuid): Reservation
    {
        $repo = new ReservationRepository();
        return $repo->get_ReservationById($uuid);
    }

    public function edit_Reservation($uuid, $session_id, $status, $adult, $kids, $comment)
    {
        $repo = new ReservationRepository();
        $repo->edit_Reservation($uuid, $session_id, $status, $adult, $kids, $comment);
    }

    public function insert_Reservation(Reservation $reservation)
    {
        $repo = new ReservationRepository();
        $repo->insert_Reservation($reservation);
    }

    public function delete_Reservation($uuid)
    {
        $repo = new ReservationRepository();
        $repo->delete_Reservation($uuid);
    }
}