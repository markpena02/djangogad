# api/urls.py
from rest_framework.routers import DefaultRouter
from django.urls import path
from .views import CampusViewSet, CollegeViewSet, OfficeViewSet, SubmissionViewSet, RemarksViewSet, CommentViewSet

router = DefaultRouter()
router.register(r'campuses', CampusViewSet)
router.register(r'colleges', CollegeViewSet)
router.register(r'offices', OfficeViewSet)
router.register(r'submissions', SubmissionViewSet)
router.register(r'remarks', RemarksViewSet)
router.register(r'comments', CommentViewSet)

urlpatterns = [
    *router.urls,
    path('colleges/campus_id/<str:campus_id>/', CollegeViewSet.as_view({'get': 'list_by_campus_id'}), name='colleges-by-campus-id'),
]
