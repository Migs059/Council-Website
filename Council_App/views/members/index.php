<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Council Members</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; color: #333; }
        .nav { margin-bottom: 15px; font-size: 16px; }
        .nav a { color: #1B365D; font-weight: bold; text-decoration: none; margin-right: 15px; }
        .nav a.active { text-decoration: underline; color: #D4AF37; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-radius: 8px 8px 0 0; border-bottom: 4px solid #D4AF37; }
        .header h2 { margin: 0; }
        .container { background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .content { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #1B365D; color: #D4AF37; padding: 12px; text-align: left; }
        td { border-bottom: 1px solid #e0e0e0; padding: 12px; }
        tr:hover { background-color: #f9fbfd; }
        .btn { padding: 8px 14px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-block; }
        .btn-add { background-color: #D4AF37; color: #1B365D; margin-bottom: 15px; }
        .btn-add:hover { background-color: #c49f27; }
        .btn-edit { background-color: #1B365D; color: #FFFFFF; }
        .btn-edit:hover { background-color: #132743; }
        .btn-delete { background-color: #c9302c; color: #FFFFFF; margin-left: 5px; }
        .btn-delete:hover { background-color: #ac2925; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php?action=index" class="active">Members Management</a> | 
        <a href="index.php?action=events">Events & Attendance</a>
    </div>

    <div class="container">
        <div class="header">
            <h2>Student Council Members</h2>
        </div>
        <div class="content">
            <a href="index.php?action=create" class="btn btn-add">+ Add New Member</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($members)): ?>
                        <?php foreach ($members as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['id']) ?></td>
                            <td><?= htmlspecialchars($m['student_id']) ?></td>
                            <td><?= htmlspecialchars($m['full_name']) ?></td>
                            <td><?= htmlspecialchars($m['position']) ?></td>
                            <td><?= htmlspecialchars($m['email']) ?></td>
                            <td>
                                <a href="index.php?action=edit&id=<?= $m['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="index.php?action=delete&id=<?= $m['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No members found. Click "+ Add New Member" above to add one.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>