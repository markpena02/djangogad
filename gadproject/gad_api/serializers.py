# api/serializers.py
from rest_framework import serializers
from .models import Campus, College, Office, Submission, Remarks, Comment

class CampusSerializer(serializers.ModelSerializer):
    class Meta:
        model = Campus
        fields = ['campus_id', 'campus_name', 'campus_address']
        read_only_fields = ['campus_id']  # Make campus_id read-only

class CollegeSerializer(serializers.ModelSerializer):
    class Meta:
        model = College
        fields = '__all__'
        read_only_fields = ['campus_id']

class OfficeSerializer(serializers.ModelSerializer):
    class Meta:
        model = Office
        fields = '__all__'
        # read_only_fields = ['campus_id']  # Make campus_id read-only

class SubmissionSerializer(serializers.ModelSerializer):
    class Meta:
        model = Submission
        fields = [
            'submission_id', 'proposal_title',  'evaluator', 'proponent',
            'proposal_description', 'resources_link', 'campus',
            'college', 'office', 'status'
        ]
        read_only_fields = ['submission_id', 'proponent','status', 'submitted_at']

    def create(self, validated_data):
        # Automatically set the proponent to the logged-in user
        request = self.context.get('request')
        validated_data['proponent'] = request.user
        return super().create(validated_data)

class RemarksSerializer(serializers.ModelSerializer):
    class Meta:
        model = Remarks
        fields = '__all__'

class CommentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Comment
        fields = '__all__'
