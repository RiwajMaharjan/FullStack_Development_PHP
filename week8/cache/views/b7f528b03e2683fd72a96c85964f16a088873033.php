

<?php $__env->startSection('content'); ?>
    <h2>Edit Student</h2>
    
    <form action="index.php?page=update&id=<?php echo e($student['id']); ?>" method="POST">
        <div style="margin-bottom: 10px;">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo e($student['name']); ?>" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo e($student['email']); ?>" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Course:</label><br>
            <input type="text" name="course" value="<?php echo e($student['course']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-edit" style="background: blue; color: white; padding: 10px; border: none; cursor: pointer;">
            Update Student
        </button>
        <a href="index.php?page=index" style="margin-left: 10px;">Cancel</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\workshop_8\app\views/students/edit.blade.php ENDPATH**/ ?>