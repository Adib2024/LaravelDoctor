import React, { useState, useEffect } from 'react';
import { View, Text, FlatList, StyleSheet } from 'react-native';

const AppointmentList = ({ route }) => {
  const [appointments, setAppointments] = useState([]);
  const { token } = route.params; // Access the token from route.params

  useEffect(() => {
    console.log("Token:", token); // Log the token value
    const fetchAppointments = async () => {
      try {
        const url = "https://lbmyz.ciroue.com/api/appoinment"; // Change the URL here

        const response = await fetch(url, {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
          }
        });

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const data = await response.json();
        setAppointments(data.data);
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        // Handle error - show an error message to the user, etc.
      }
    };

    fetchAppointments();
  }, [token]); // Include token in the dependency array

  const renderItem = ({ item, index }) => {
    const backgroundColor = index % 2 === 0 ? '#E1BEE7' : '#B2DFDB'; // Alternating background colors
    return (
      <View style={[styles.item, { backgroundColor }]}>
        <Text style={styles.title}>{item.title}</Text>
        <Text>Start Date: {item.startDate}</Text>
        <Text>End Date: {item.endDate}</Text>
        <View style={styles.attendeesContainer}>
          <Text style={styles.attendeesTitle}>Attendees:</Text>
          <Text style={styles.attendees}>{item.attendees}</Text>
        </View>
        <Text style={styles.smallText}>Created At: {item.created_at}</Text>
        <Text style={styles.smallText}>Updated At: {item.updated_at}</Text>
      </View>
    );
  };

  return (
    <View style={styles.container}>
      <Text style={styles.mainTitle}>Appointments</Text>
      <FlatList
        data={appointments}
        renderItem={renderItem}
        keyExtractor={(item) => item.id.toString()} // Assuming appointments have unique IDs
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    marginTop: 20,
    marginHorizontal: 10,
    backgroundColor: '#E0E0E0', // Light grey background color
    paddingHorizontal: 10,
    paddingVertical: 20,
    borderRadius: 15,
  },
  mainTitle: {
    fontSize: 28,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: '#512DA8', // Deep purple color
  },
  item: {
    padding: 20,
    marginBottom: 15,
    borderRadius: 10,
  },
  title: {
    fontWeight: 'bold',
    fontSize: 18,
    marginBottom: 5,
    color: '#4527A0', // Dark purple color
  },
  attendeesContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginTop: 5,
  },
  attendeesTitle: {
    fontWeight: 'bold',
    marginRight: 5,
    color: '#1A237E', // Dark blue color
  },
  attendees: {
    backgroundColor: '#FFEB3B', // Yellow color
    paddingVertical: 3,
    paddingHorizontal: 8,
    borderRadius: 5,
  },
  smallText: {
    fontSize: 12,
    color: '#757575', // Grey color
  },
});

export default AppointmentList;
