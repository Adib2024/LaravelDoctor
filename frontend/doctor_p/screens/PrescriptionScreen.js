import React, { useState, useEffect } from 'react';
import { View, Text, FlatList, StyleSheet, ImageBackground } from 'react-native';

const MedicineList = ({ route }) => {
  const [medicines, setMedicines] = useState([]);
  const { token } = route.params;

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch("https://lbmyz.ciroue.com/api/medicine", {
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
        setMedicines(data.data);
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    };

    fetchData();
  }, []);

  const renderItem = ({ item }) => (
    <ImageBackground
      source={{ uri: 'https://img.freepik.com/free-vector/medical-healthcare-blue-color_1017-26807.jpg' }}
      style={styles.itemBackground}
      imageStyle={{ borderRadius: 10 }}
    >
      <View style={styles.item}>
        <Text style={styles.text}>Code: {item.code}</Text>
        <Text style={styles.text}>Name: {item.name}</Text>
        <Text style={styles.text}>Price: {item.price}</Text>
        <Text style={styles.text}>Expired: {item.expired}</Text>     
      </View>
    </ImageBackground>
  );

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Prescription Management</Text>
      <FlatList
        data={medicines}
        renderItem={renderItem}
        keyExtractor={item => item.id.toString()}
        contentContainerStyle={styles.flatListContent}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    paddingHorizontal: 20,
    paddingTop: 40,
  },
  title: {
    fontSize: 28,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: '#00509D',
  },
  flatListContent: {
    paddingTop: 10,
  },
  itemBackground: {
    flex: 1,
    justifyContent: 'center',
    marginVertical: 10,
    height: 150,
    borderRadius: 10,
    overflow: 'hidden',
  },
  item: {
    backgroundColor: 'rgba(255, 255, 255, 0.9)',
    padding: 20,
    borderRadius: 10,
  },
  text: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 5,
    color: '#333',
  },
});

export default MedicineList;
