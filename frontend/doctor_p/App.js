//App.js
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

import RegisterScreen from './screens/RegisterScreen';
import LoginScreen from './screens/LoginScreen';
import MenuScreen from './screens/MenuScreen';
import AppoinmentScreen from './screens/AppointmentScreen';
import MakeAppointmentScreen from './screens/MakeAppointmentScreen';
import PrescriptionScreen from './screens/PrescriptionScreen';

const Stack = createStackNavigator();

const App = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Register">
        <Stack.Screen name="Register" component={RegisterScreen} />
        <Stack.Screen name="Login" component={LoginScreen} />
        <Stack.Screen name="Menu" component={MenuScreen} />
        <Stack.Screen name="Appointment" component={AppoinmentScreen} />
        <Stack.Screen name="MakeAppointment" component={MakeAppointmentScreen} />
        <Stack.Screen name="Prescription" component={PrescriptionScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default App;
