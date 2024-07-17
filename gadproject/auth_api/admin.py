# from django.contrib import admin
# from django.contrib.auth.admin import UserAdmin
# from .models import User

# # Unregister the default User model registration
# admin.site.unregister(User)

# class CustomUserAdmin(UserAdmin):
#     model = User
#     list_display = ('user_id', 'username', 'name', 'email', 'role', 'created_at', 'is_active', 'is_staff')
#     list_filter = ('role', 'is_active', 'is_staff')
#     search_fields = ('username', 'email', 'name', 'user_id')
#     ordering = ('user_id',)
#     fieldsets = (
#         (None, {'fields': ('username', 'password')}),
#         ('Personal info', {'fields': ('name', 'email')}),
#         ('Permissions', {'fields': ('is_active', 'is_staff', 'is_superuser', 'groups', 'user_permissions')}),
#         ('Important dates', {'fields': ('last_login', 'date_joined')}),
#         ('Role & ID', {'fields': ('role', 'user_id')}),
#     )
#     add_fieldsets = (
#         (None, {
#             'classes': ('wide',),
#             'fields': ('username', 'name', 'email', 'role', 'password1', 'password2'),
#         }),
#     )

# admin.site.register(User, CustomUserAdmin)
