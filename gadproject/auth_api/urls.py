from django.urls import path
from .views import (
    ChangePasswordView,
    CurrentUserDetailView,
    EvaluatorListView,
    ProponentListView,
    UserRegistrationView,
    AdminTokenObtainPairView,
    EvaluatorTokenObtainPairView,
    ProponentTokenObtainPairView,
    CustomTokenRefreshView,
    LogoutView,
    UserListView,
    UserDetailView,
)

urlpatterns = [
    path('register/', UserRegistrationView.as_view(), name='register'),
    path('login/admin/', AdminTokenObtainPairView.as_view(), name='admin_token_obtain_pair'),
    path('login/evaluator/', EvaluatorTokenObtainPairView.as_view(), name='evaluator_token_obtain_pair'),
    path('login/proponent/', ProponentTokenObtainPairView.as_view(), name='proponent_token_obtain_pair'),
    path('token/refresh/', CustomTokenRefreshView.as_view(), name='token_refresh'),
    path('logout/', LogoutView.as_view(), name='logout'),
    path('users/', UserListView.as_view(), name='user-list'),
    path('users/<int:pk>/', UserDetailView.as_view(), name='user-detail'),
    path('current-user/', CurrentUserDetailView.as_view(), name='current-user-detail'),
    path('users/change-password/', ChangePasswordView.as_view(), name='change-password'),
    path('users/evaluators/', EvaluatorListView.as_view(), name='evaluator-list'),
    path('users/proponents/', ProponentListView.as_view(), name='proponent-list'),
]
