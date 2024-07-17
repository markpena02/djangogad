# auth_api/serializers.py

from rest_framework import serializers
from rest_framework_simplejwt.serializers import TokenObtainPairSerializer
from .models import User

class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ['id', 'username', 'email', 'password', 'role', 'name', 'created_at', 'user_id']
        extra_kwargs = {
            'password': {'write_only': True, 'required' : False},
            'created_at': {'read_only': True},
            'username': {'required': False},
            'role': {'required': False},
        }

    def create(self, validated_data):
        user = User.objects.create_user(
            username=validated_data['username'],
            email=validated_data['email'],
            password=validated_data['password'],
            role=validated_data['role'],
            name=validated_data['name'],
            # name=validated_data['name'],
        )
        return user

    def update(self, instance, validated_data):
        # Update only the provided fields
        instance.username = validated_data.get('username', instance.username)
        instance.email = validated_data.get('email', instance.email)
        instance.name = validated_data.get('name', instance.name)

        password = validated_data.get('password')
        if password:
            instance.set_password(password)

        instance.save()
        return instance



class CustomTokenObtainPairSerializer(TokenObtainPairSerializer):
    expected_role = None  # To be set in subclass

    def validate(self, attrs):
        data = super().validate(attrs)
        
        # Check the user's role
        if self.user.role != self.expected_role:
            raise serializers.ValidationError({'detail': f'You do not have permission to access this resource as {self.expected_role}.'})
        
        # Include role information in the response
        data['role'] = self.user.role
        
        return data
    
class AdminTokenObtainPairSerializer(CustomTokenObtainPairSerializer):
    expected_role = 'admin'

class EvaluatorTokenObtainPairSerializer(CustomTokenObtainPairSerializer):
    expected_role = 'evaluator'

class ProponentTokenObtainPairSerializer(CustomTokenObtainPairSerializer):
    expected_role = 'proponent'
