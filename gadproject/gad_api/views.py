# views.py
from rest_framework import viewsets, status
from rest_framework.response import Response
from rest_framework.permissions import IsAuthenticated, AllowAny
# from .permissions import IsAdminOrReadOnly, IsEvaluatorOrReadOnly
from .models import  Campus, College, Office, Submission, Remarks, Comment
from .serializers import CampusSerializer, CollegeSerializer, OfficeSerializer, SubmissionSerializer, RemarksSerializer, CommentSerializer
from django_filters.rest_framework import DjangoFilterBackend
from rest_framework.decorators import action

class CampusViewSet(viewsets.ModelViewSet):
    queryset = Campus.objects.all()
    serializer_class = CampusSerializer
    permission_classes = [AllowAny]

class CollegeViewSet(viewsets.ModelViewSet):
    queryset = College.objects.all()
    serializer_class = CollegeSerializer
    permission_classes = [AllowAny]

    @action(detail=False, methods=['get'], url_path='campus_id/(?P<campus_id>[^/.]+)')
    def list_by_campus_id(self, request, campus_id=None):
        colleges = self.queryset.filter(campus__campus_id=campus_id)
        serializer = self.get_serializer(colleges, many=True)
        return Response(serializer.data)

class OfficeViewSet(viewsets.ModelViewSet):
    queryset = Office.objects.all()
    serializer_class = OfficeSerializer
    permission_classes = [AllowAny]

class SubmissionViewSet(viewsets.ModelViewSet):
    queryset = Submission.objects.all()
    serializer_class = SubmissionSerializer
    permission_classes = [AllowAny]

    def update(self, request, *args, **kwargs):
        submission = self.get_object()
        if request.user.is_staff:  # Assuming staff users are admins
            serializer = self.get_serializer(submission, data=request.data, partial=True)
            serializer.is_valid(raise_exception=True)
            self.perform_update(serializer)
            return Response(serializer.data)
        elif submission.evaluator == request.user:  # Check if the user is the assigned evaluator
            serializer = self.get_serializer(submission, data=request.data, partial=True)
            serializer.is_valid(raise_exception=True)
            self.perform_update(serializer)
            return Response(serializer.data)
        else:
            return Response(status=status.HTTP_403_FORBIDDEN)
        
    def perform_create(self, serializer):
        serializer.save(proponent=self.request.user)

class RemarksViewSet(viewsets.ModelViewSet):
    queryset = Remarks.objects.all()
    serializer_class = RemarksSerializer
    permission_classes = [AllowAny]

    def create(self, request, *args, **kwargs):
        submission = Submission.objects.get(pk=request.data['submission'])
        if request.user == submission.evaluator:
            serializer = self.get_serializer(data=request.data)
            serializer.is_valid(raise_exception=True)
            self.perform_create(serializer)
            # Update the status of the submission
            submission.status = 'approved'
            submission.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        else:
            return Response(status=status.HTTP_403_FORBIDDEN)

class CommentViewSet(viewsets.ModelViewSet):
    queryset = Comment.objects.all()
    serializer_class = CommentSerializer
    permission_classes = [IsAuthenticated]
