//MenuScreen.js
import React from 'react';
import { StyleSheet, Text, View, Image, TouchableOpacity, ScrollView } from 'react-native';
import { useNavigation } from '@react-navigation/native';

const MenuScreen = ({ route }) => {
  const navigation = useNavigation();
  const { token } = route.params;

  const handleMenuItemPress = (title) => {
    if (title === 'Appointment') {
      navigation.navigate('Appointment', { token }); // Pass the token when navigating to AppointmentScreen
    } 
    else if (title === 'Consult') {
      navigation.navigate('MakeAppointment', { token }); // Pass the token when navigating to AppointmentScreen
    } 
    else if (title === 'Prescription') {
      navigation.navigate('Prescription', { token }); // Pass the token when navigating to AppointmentScreen
    } 
    else {
      // Handle other menu item clicks here
    }
  };

  const menuItems = [
    { title: 'Prescription', icon: 'https://cdn-icons-png.flaticon.com/512/7918/7918229.png' },
    { title: 'Consult', icon: 'https://cdn-icons-png.flaticon.com/512/4383/4383086.png' },
    { title: 'Appointment', icon: 'https://cdn-icons-png.flaticon.com/512/1572/1572132.png' },
    { title: 'See All', icon: 'https://img.icons8.com/color/70/000000/user.png' }
  ];

  return (
    <ScrollView contentContainerStyle={styles.container}>
      {menuItems.map((item, index) => (
        <TouchableOpacity key={index} style={styles.menuBox} onPress={() => handleMenuItemPress(item.title)}>
          <Image
            style={styles.icon}
            source={{ uri: item.icon }}
          />
          <Text style={styles.info}>{item.title}</Text>
        </TouchableOpacity>
      ))}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    paddingTop: 40,
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
    paddingHorizontal: 12,
  },
  menuBox: {
    width: '23%',
    aspectRatio: 1,
    alignItems: 'center',
    justifyContent: 'center',
    marginVertical: 12,
  },
  icon: {
    width: '60%',
    aspectRatio: 1,
  },
  info: {
    fontSize: 16,
    color: '#696969',
    marginTop: 8,
  },
});

export default MenuScreen;
