from django.utils import timezone
from django.db import models
from auth_api.models import User

class Campus(models.Model):
    campus_id = models.CharField(max_length=4, primary_key=True)
    campus_name = models.CharField(max_length=255)
    campus_address = models.CharField(max_length=255)

    def save(self, *args, **kwargs):
        if not self.campus_id:
            latest_campus = Campus.objects.order_by('-campus_id').first()
            if latest_campus:
                latest_id = int(latest_campus.campus_id[2:]) + 1
            else:
                latest_id = 1
            self.campus_id = f"uc{latest_id:04}"
        super().save(*args, **kwargs)

    def __str__(self):
        return self.campus_name

class College(models.Model):
    college_id = models.CharField(max_length=4, primary_key=True, editable=False)
    college_name = models.CharField(max_length=255)
    campus = models.ForeignKey(Campus, on_delete=models.CASCADE)

    def save(self, *args, **kwargs):
        if not self.college_id:
            latest_college = College.objects.order_by('-college_id').first()
            if latest_college:
                latest_id = int(latest_college.college_id[2:]) + 1
            else:
                latest_id = 1
            self.college_id = f"c{latest_id:04}"
        super().save(*args, **kwargs)

    def __str__(self):
        return self.college_name

class Office(models.Model):
    office_id = models.CharField(max_length=6, primary_key=True, editable=False)
    office_name = models.CharField(max_length=255)
    college = models.ForeignKey(College, on_delete=models.CASCADE)
    campus = models.ForeignKey(Campus, on_delete=models.CASCADE)

    def save(self, *args, **kwargs):
        if not self.office_id:
            latest_office = Office.objects.order_by('-office_id').first()
            if latest_office:
                latest_id = int(latest_office.office_id[2:]) + 1
            else:
                latest_id = 1
            self.office_id = f"of{latest_id:04}"
        super().save(*args, **kwargs)

    def __str__(self):
        return self.office_name

class Submission(models.Model):
    STATUS_CHOICES = [
        ('pending', 'Pending'),
        ('approved', 'Approved'),
    ]
    
    submission_id = models.CharField(max_length=20, primary_key=True, editable=False)
    proponent = models.ForeignKey(User, on_delete=models.CASCADE, related_name='submissions', limit_choices_to={'role': 'proponent'})
    evaluator = models.ForeignKey(User, on_delete=models.CASCADE, related_name='evaluated_submissions', limit_choices_to={'role': 'evaluator'})
    campus = models.ForeignKey(Campus, on_delete=models.CASCADE, null=True, blank=True)
    college = models.ForeignKey(College, on_delete=models.CASCADE, null=True, blank=True)
    office = models.ForeignKey(Office, on_delete=models.CASCADE, null=True, blank=True)
    proposal_title = models.CharField(max_length=255)
    proponents = models.TextField()
    proposal_description = models.TextField()
    resources_link = models.CharField(max_length=512)
    status = models.CharField(max_length=20, choices=STATUS_CHOICES, default='pending')
    remarks_id = models.CharField(max_length=7, editable=False)
    submitted_at = models.DateTimeField(default=timezone.now)

    def save(self, *args, **kwargs):
        if not self.submission_id:
            latest_submission = Submission.objects.order_by('-submission_id').first()
            if latest_submission:
                latest_id = int(latest_submission.submission_id.split('-')[-1]) + 1
            else:
                latest_id = 1
            self.submission_id = f"s-{latest_id:05}"
        super().save(*args, **kwargs)

    def toggle_status(self):
        if self.status == 'pending':
            self.status = 'approved'
        elif self.status == 'approved':
            self.status = 'pending'
        self.save()

    def __str__(self):
        return self.proposal_title

class Remarks(models.Model):
    remarks_id = models.CharField(max_length=7, primary_key=True, editable=False)
    submission = models.ForeignKey(Submission, on_delete=models.CASCADE)
    remarks = models.TextField()
    timestamp = models.DateTimeField()

    def save(self, *args, **kwargs):
        if not self.remarks_id:
            latest_remarks = Remarks.objects.order_by('-remarks_id').first()
            if latest_remarks:
                latest_id = int(latest_remarks.remarks_id[1:]) + 1
            else:
                latest_id = 1
            self.remarks_id = f"r{latest_id:06}"
        super().save(*args, **kwargs)

    def __str__(self):
        return self.remarks

class Comment(models.Model):
    comment_id = models.CharField(max_length=20, primary_key=True, editable=False)
    submission = models.ForeignKey(Submission, on_delete=models.CASCADE)
    comment_text = models.TextField()
    timestamp = models.DateTimeField()

    def save(self, *args, **kwargs):
        if not self.comment_id:
            latest_comment = Comment.objects.order_by('-comment_id').first()
            if latest_comment:
                latest_id = int(latest_comment.comment_id[3:]) + 1
            else:
                latest_id = 1
            self.comment_id = f"cmt{latest_id:014}"
        super().save(*args, **kwargs)

    def __str__(self):
        return self.comment_text
