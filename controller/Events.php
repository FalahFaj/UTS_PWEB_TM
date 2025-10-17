<?php
require_once 'koneksi.php';

class EventsController {
    // Return JSON list of events for FullCalendar
    public function list() {
        header('Content-Type: application/json');

        // FullCalendar sends start/end as ISO strings; accept them
        $start = isset($_GET['start']) ? $_GET['start'] : null;
        $end = isset($_GET['end']) ? $_GET['end'] : null;

        try {
            $pdo = getPDO();
        } catch (Exception $e) {
            echo json_encode([]);
            return;
        }

        // Basic query: select events in range if provided
        $sql = "SELECT id, title, start, `end`, description FROM events";
        $params = [];
        if ($start && $end) {
            $sql .= " WHERE (start BETWEEN ? AND ?) OR (`end` BETWEEN ? AND ?)
                OR (start <= ? AND (`end` IS NULL OR `end` >= ?))";
            $params = [$start, $end, $start, $end, $start, $end];
        }

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo json_encode([]);
            return;
        }

        $events = [];
        foreach ($rows as $r) {
            $events[] = [
                'id' => $r['id'],
                'title' => $r['title'],
                'start' => $r['start'],
                'end' => $r['end'],
                'allDay' => (strpos($r['start'], '00:00:00') !== false && ($r['end'] === null || strpos($r['end'], '00:00:00') !== false)),
                'extendedProps' => ['description' => $r['description']],
            ];
        }

        echo json_encode($events);
    }
}
