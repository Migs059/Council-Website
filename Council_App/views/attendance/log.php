<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Attendance</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; }
        .container { max-width: 800px; margin: 0 auto; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-bottom: 4px solid #D4AF37; }
        form { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #1B365D; color: #D4AF37; padding: 10px; text-align: left; }
        td { border-bottom: 1px solid #e0e0e0; padding: 10px; }
        .btn { padding: 10px 18px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; text-decoration: none; }
        .btn-save { background-color: #D4AF37; color: #1B365D; margin-left: 10px; }
        .btn-cancel { background-color: #1B365D; color: #FFFFFF; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">Attendance Log: <?= htmlspecialchars($event['title']) ?></h2>
            <small><?= htmlspecialchars($event['event_date']) ?> | <?= htmlspecialchars($event['location']) ?></small>
        </div>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Position</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['full_name']) ?></td>
                        <td><?= htmlspecialchars($r['position']) ?></td>
                        <td>
                            <select name="attendance[<?= $r['member_id'] ?>]">
                                <?php $status = $r['status'] ?? 'Absent'; ?>
                                <option value="Present" <?= $status === 'Present' ? 'selected' : '' ?>>Present</option>
                                <option value="Absent" <?= $status === 'Absent' ? 'selected' : '' ?>>Absent</option>
                                <option value="Late" <?= $status === 'Late' ? 'selected' : '' ?>>Late</option>
                                <option value="Excused" <?= $status === 'Excused' ? 'selected' : '' ?>>Excused</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-save">Save Attendance</button>
            <a href="index.php?action=events" class="btn btn-cancel">Back to Events</a>
        </form>
    </div>
</body>
</html>