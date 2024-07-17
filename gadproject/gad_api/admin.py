# gad_api/admin.py

from django.contrib import admin
from .models import User, Campus, College, Office, Submission, Remarks, Comment

admin.site.register(User)
admin.site.register(Campus)
admin.site.register(College)
admin.site.register(Office)
admin.site.register(Submission)
admin.site.register(Remarks)
admin.site.register(Comment)
