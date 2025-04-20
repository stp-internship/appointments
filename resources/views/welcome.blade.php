<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المواعيد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Tahoma', Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #dee2e6;
        }
        h2, h3 {
            color: #343a40;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 20px;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #3a5ec0;
            border-color: #3a5ec0;
        }
        .btn-warning {
            background-color: #f6c23e;
            border-color: #f6c23e;
        }
        .btn-danger {
            background-color: #e74a3b;
            border-color: #e74a3b;
        }
        .table-responsive {
            margin: 20px 0;
        }
        .alert {
            margin: 20px 0;
        }
        .past-appointment {
            opacity: 0.8;
        }
    </style>
</head>
<body dir="rtl">

<div class="container mt-4">
    <!-- Form Section -->
    <div class="form-container mb-4">
        <h2 class="text-center">إضافة/تعديل موعد</h2>
        <form action="{{ isset($appointment) ? route('appointments.update', $appointment->id) : route('appointments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">عنوان الموعد</label>
                    <input type="text" name="title" class="form-control" id="title" required value="{{ $appointment->title ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="appointment_date" class="form-label">تاريخ ووقت الموعد</label>
                    <input type="datetime-local" name="appointment_date" class="form-control" id="appointment_date" required value="{{ $appointment->appointment_date ?? '' }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea name="description" class="form-control" id="description" rows="3" required>{{ $appointment->description ?? '' }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">
                    {{ isset($appointment) ? 'تعديل الموعد' : 'إضافة موعد' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Message Section -->
    @if(session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- Appointments List Section -->
    <h3 class="text-center">قائمة المواعيد</h3>

    @if (isset($appointments))
        @if($appointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>تاريخ الموعد</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr class="{{ \Carbon\Carbon::parse($appointment->appointment_date)->isPast() ? 'table-danger past-appointment' : '' }}">
                                <td>{{ $appointment->title }}</td>
                                <td>{{ $appointment->description }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>لا يوجد مواعيد مسجلة</h4>
                <p>يمكنك إضافة موعد جديد باستخدام النموذج أعلاه</p>
            </div>
        @endif
    @else
        <div class="alert alert-warning text-center">
            <h4>لا توجد بيانات متاحة</h4>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
