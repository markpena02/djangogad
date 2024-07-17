from django.contrib.auth.models import AbstractUser, Group, Permission
from django.db import models
from django.utils import timezone

class User(AbstractUser):
    ROLE_CHOICES = (
        ('admin', 'Admin'),
        ('proponent', 'Proponent'),
        ('evaluator', 'Evaluator'),
    )

    role = models.CharField(max_length=20, choices=ROLE_CHOICES)
    user_id = models.CharField(max_length=20, unique=True, editable=False)
    name = models.CharField(max_length=255, blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, null=True)

    groups = models.ManyToManyField(
        Group,
        related_name='auth_api_user_set',  # Add related_name to avoid conflict
        blank=True,
        help_text=(
            'The groups this user belongs to. A user will get all permissions '
            'granted to each of their groups.'
        ),
        verbose_name='groups',
    )
    user_permissions = models.ManyToManyField(
        Permission,
        related_name='auth_api_user_set',  # Add related_name to avoid conflict
        blank=True,
        help_text='Specific permissions for this user.',
        verbose_name='user permissions',
    )

    def save(self, *args, **kwargs):
        if not self.user_id:
            if self.role == 'admin':
                latest_user = User.objects.filter(role='admin').order_by('-user_id').first()
                if latest_user:
                    latest_id = int(latest_user.user_id[2:]) + 1
                else:
                    latest_id = 1
                self.user_id = f"ad{latest_id:04}"

            elif self.role == 'proponent':
                latest_user = User.objects.filter(role='proponent').order_by('-user_id').first()
                if latest_user:
                    latest_id = int(latest_user.user_id[1:]) + 1
                else:
                    latest_id = 1
                self.user_id = f"p{latest_id:04}"

            elif self.role == 'evaluator':
                latest_user = User.objects.filter(role='evaluator').order_by('-user_id').first()
                if latest_user:
                    latest_id = int(latest_user.user_id[1:]) + 1
                else:
                    latest_id = 1
                self.user_id = f"e{latest_id:04}"

        if not self.created_at:
            self.created_at = timezone.now()

        super().save(*args, **kwargs)

    def __str__(self):
        return self.username or self.name
