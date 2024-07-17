from django.contrib import admin
from django.urls import path, include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('auth/', include('auth_api.urls')),
    path('api/', include('gad_api.urls')),
]
