import { Resolver, Query, Mutation, Args } from '@nestjs/graphql';

interface Hotel {
  id: string;
  name: string;
  address: string;
  phone: string;
}

@Resolver('Hotel') // Matches the name of the GraphQL type in your schema
export class HotelResolver {
  private hotels: Hotel[] = [];
  private idCounter = 1;

  @Query(() => [String], { name: 'hotels' }) // name must match schema
  getHotels(): Hotel[] {
    return this.hotels;
  }

  @Query(() => String, { name: 'hotel', nullable: true })
  getHotel(@Args('id') id: string): Hotel | null {
    return this.hotels.find((h) => h.id === id) || null;
  }

  @Mutation(() => String, { name: 'createHotel' })
  createHotel(
    @Args('name') name: string,
    @Args('address') address: string,
    @Args('phone') phone: string,
  ): Hotel {
    const hotel: Hotel = {
      id: String(this.idCounter++),
      name,
      address,
      phone,
    };
    this.hotels.push(hotel);
    return hotel;
  }

  @Mutation(() => String, { name: 'updateHotel', nullable: true })
  updateHotel(
    @Args('id') id: string,
    @Args('name', { nullable: true }) name?: string,
    @Args('address', { nullable: true }) address?: string,
    @Args('phone', { nullable: true }) phone?: string,
  ): Hotel | null {
    const hotel = this.hotels.find((h) => h.id === id);
    if (!hotel) return null;
    if (name !== undefined) hotel.name = name;
    if (address !== undefined) hotel.address = address;
    if (phone !== undefined) hotel.phone = phone;
    return hotel;
  }

  @Mutation(() => Boolean, { name: 'deleteHotel' })
  deleteHotel(@Args('id') id: string): boolean {
    const idx = this.hotels.findIndex((h) => h.id === id);
    if (idx === -1) return false;
    this.hotels.splice(idx, 1);
    return true;
  }
}
