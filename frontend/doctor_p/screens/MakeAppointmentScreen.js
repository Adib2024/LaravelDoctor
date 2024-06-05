import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Alert } from 'react-native';
import { useNavigation } from '@react-navigation/native';

const MakeAppointment = ({ route }) => {
  const navigation = useNavigation();
  const { token } = route.params;

  const [title, setTitle] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [attendees, setAttendees] = useState('');

  const handleAppointmentSubmission = async () => {
    if (!token) {
      // Handle case where token is missing
      Alert.alert('Error', 'Token is missing. Please log in again.');
      navigation.navigate('Login');
      return;
    }

    if (!title || !startDate || !endDate || !attendees) {
      // Handle case where any required field is empty
      Alert.alert('Error', 'Please fill in all fields.');
      return;
    }

    // Validate date format (YYYY-MM-DD HH:mm:ss)
    const dateFormat = /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/;
    if (!startDate.match(dateFormat) || !endDate.match(dateFormat)) {
      Alert.alert('Error', 'Please enter dates in the format YYYY-MM-DD HH:mm:ss.');
      return;
    }

    try {
      const appointmentData = {
        title,
        startDate,
        endDate,
        attendees
      };

      const response = await fetch('https://lbmyz.ciroue.com/api/appoinment', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(appointmentData)
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      // Appointment successfully created
      const responseData = await response.json();
      Alert.alert('Success', 'Appointment created successfully.');
      console.log('Appointment data:', responseData.data);
      navigation.navigate('Appointment', { token });
    } catch (error) {
      console.error('Error creating appointment:', error);
      Alert.alert('Error', 'Failed to create appointment. Please try again.');
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Make Appointment</Text>
      <TextInput
        style={styles.input}
        placeholder="Title"
        value={title}
        onChangeText={setTitle}
      />
      <TextInput
        style={styles.input}
        placeholder="Start Date (YYYY-MM-DD HH:mm:ss)"
        value={startDate}
        onChangeText={setStartDate}
      />
      <TextInput
        style={styles.input}
        placeholder="End Date (YYYY-MM-DD HH:mm:ss)"
        value={endDate}
        onChangeText={setEndDate}
      />
      <TextInput
        style={styles.input}
        placeholder="Attendees (comma separated)"
        value={attendees}
        onChangeText={setAttendees}
      />
      <TouchableOpacity style={styles.submitButton} onPress={handleAppointmentSubmission}>
        <Text style={styles.submitButtonText}>Submit</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  title: {
    fontSize: 24,
    marginBottom: 20,
  },
  input: {
    width: '80%',
    height: 40,
    borderColor: 'gray',
    borderWidth: 1,
    borderRadius: 5,
    marginBottom: 20,
    paddingHorizontal: 10,
  },
  submitButton: {
    backgroundColor: 'blue',
    padding: 10,
    borderRadius: 5,
  },
  submitButtonText: {
    color: 'white',
    fontSize: 16,
  },
});

export default MakeAppointment;
